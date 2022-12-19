<?php

namespace GateGem\Core\Traits;

use GateGem\Core\Livewire\Modal;
use GateGem\Core\Loader\TableLoader;
use GateGem\Core\Support\Config\ConfigManager;
use GateGem\Core\Support\Config\FieldConfig;
use GateGem\Core\Support\Config\FormConfig;
use Livewire\WithFileUploads;

trait WithTableEdit
{
    use WithFileUploads;
    public $module = '';
    public $dataId = 0;
    public $isFormNew = true;
    public $rules = [];
    public function mount()
    {
        return $this->LoadData();
    }
    protected function getView()
    {
        return 'core::table.edit';
    }
    public function getOptionProperty()
    {
        if (method_exists($this, "getOption")) return $this->getOption();
        return TableLoader::getDataByKey($this->module);
    }
    public function getFieldsProperty()
    {
        return  getValueByKey($this->getOptionProperty(), ConfigManager::FIELDS, []);
    }
    public function LoadData()
    {
        $option = $this->getOptionProperty();
        if (!$option || !isset($option[ConfigManager::MODEL]) || $option[ConfigManager::MODEL] == '')
            return abort(404);

        if (!$this->modal_isPage) {
            $this->modal_size = getValueByKey($option, ConfigManager::FORM . '.' . FormConfig::FORM_SIZE,  Modal::FullscreenMd);
        }
        $this->setTitle(__(getValueByKey($option, ConfigManager::TITLE, 'core::tables.' . $this->module . '.title')));
        $fields = $this->getFieldsProperty();
        $data = null;
        if ($this->dataId) {
            // edit
            $data = app($option[ConfigManager::MODEL])->find($this->dataId);
            if (!$data)
                return abort(404);
            $this->isFormNew = false;
        } else {
            // new
            $data = new (app($option[ConfigManager::MODEL]));
        }
        foreach ($fields as $item) {
            if ($item->checkKey(FieldConfig::FIELD)) {
                if (isset($data->{$item[FieldConfig::FIELD]}))
                    $this->{$item[FieldConfig::FIELD]} = $data->{$item[FieldConfig::FIELD]};
                else {
                    if ($this->isFormNew) {
                        $default_value = getValueByKey($item, FieldConfig::DATA_DEFAULT, '');
                        if (is_callable($default_value))
                            $this->{$item[FieldConfig::FIELD]} = $default_value($this->isFormNew);
                        else
                            $this->{$item[FieldConfig::FIELD]} = $default_value;
                    } else {
                        $default_value = getValueByKey($item, FieldConfig::DATA_DEFAULT, '');
                        if (is_callable($default_value))
                            $this->{$item[FieldConfig::FIELD]} = $default_value($this->isFormNew);
                        else
                            $this->{$item[FieldConfig::FIELD]} = '';
                    }
                }
            }
        }
        $fnRule = getValueByKey($option, ConfigManager::FORM . '.' . FormConfig::FORM_RULE, null);
        if ($fnRule) {
            $this->rules = $fnRule($this->dataId, $this->isFormNew) ?? [];
        }
        $fnRuleMessages = getValueByKey($option, ConfigManager::FORM . '.' . FormConfig::FORM_MESSAGE, null);
        if ($fnRuleMessages) {
            $this->messages = $fnRuleMessages($this->dataId, $this->isFormNew) ?? [];
        }
        do_action("module_edit_loaddata", $this->module, $this);
        do_action("module_edit_" . $this->module . "_loaddata", $this);
    }
    public function LoadModule($module, $dataId = null)
    {
        $this->dataId = $dataId;
        if (!$module) return abort(404);
        $this->module = $module;
        if (!$this->_code_permission)
            $this->_code_permission = 'core.' . $this->module . ($dataId ? '.edit' : '.add');
        if (!$this->checkPermissionView())
            return abort(403);
        $this->LoadData();
    }
    public function SaveForm()
    {
        if ($this->rules && count($this->rules) > 0)
            $this->validate();

        $option = $this->getOptionProperty();
        $data = null;
        if ($this->dataId) {
            // edit
            $data = app($option[ConfigManager::MODEL])->find($this->dataId);
            if (!$data)
                return abort(404);
            $this->isFormNew = false;
        } else {
            // new
            $data = new (app($option[ConfigManager::MODEL]));
        }
        $fields = $this->getFieldsProperty();
        if (method_exists($this, 'beforeBinding')) {
            $this->beforeBinding();
        }
        foreach ($fields as $item) {
            if ($item->checkKey(FieldConfig::FIELD)) {
                $valuePreview = $this->{$item[FieldConfig::FIELD]};
                if ($valuePreview && $valuePreview instanceof \Illuminate\Http\UploadedFile) {
                    if (isset($item[FieldConfig::FOLDER]) && $item[FieldConfig::FOLDER] != '')
                        $valuePreview = $valuePreview->store('public/' . $item[FieldConfig::FOLDER]);
                    else
                        $valuePreview = $valuePreview->store('public');
                    $valuePreview = str_replace('public', 'storage', $valuePreview);
                }
                $data->{$item[FieldConfig::FIELD]} =  $valuePreview;
            }
        }
        if (method_exists($this, 'beforeSave')) {
            $this->beforeSave();
        }
        $data->save();
        $this->refreshData(['module' => $this->module]);
        $this->hideModal();
        $this->ShowMessage('Update successful!');
    }
    public function render()
    {
        return $this->viewModal($this->getView(), [
            'option' => $this->option,
            'fields' => $this->fields
        ]);
    }
    public function CheckNullAndEmptySetValue($arrayField, $default)
    {
        foreach ($arrayField as $field) {
            if (isset($this->{$field}) && ($this->{$field} == null || $this->{$field} == '')) {
                $this->{$field} = $default;
            }
        }
    }
}
