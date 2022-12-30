<?php

namespace GateGem\Core\Traits;

use GateGem\Core\Livewire\Modal;
use GateGem\Core\Loader\TableLoader;
use GateGem\Core\Support\Config\ConfigManager;
use GateGem\Core\Support\Config\FieldConfig;
use GateGem\Core\Support\Config\FormConfig;

trait WithTableEdit
{
    use WithFieldSave;
    public $module = '';
    public $dataId = 0;
    public $isFormNew = true;
    public $rules = [];
    private $flgDataCache = false;
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
            $this->modal_size = $option->getValueInForm(FormConfig::FORM_SIZE, Modal::Large);
        }
        $this->setTitle(__($option->getTitle('core::tables.' . $this->module . '.title')));
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
            $this->flgDataCache = true;
            $item->DoFuncData($this->__request, $this);
            $field_name = $item->getField();
            if ($field_name) {
                if (isset($data->{$field_name}))
                    $this->{$field_name} = $data->{$field_name};
                else {
                    $default_value = $item->getDataDefault(null);
                    if ($default_value && is_callable($default_value))
                        $default_value = $default_value($this->isFormNew);
                    else {
                        if ($default_value === null && ($item->getDataTextDefault(null) === null)) {
                            $key = $item->getDataKey();
                            $dataCache = $item->getDataCache();
                            if ($dataCache && count($dataCache) > 0) {
                                $default_value = $dataCache[0][$key];
                            }
                        }
                    }
                    if ($funcBindData = $item->getFuncDataBing()) {
                        $default_value = $funcBindData($this->isFormNew, $this->__Params, $this);
                    }
                    $this->{$field_name} = $default_value;
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
            $this->flgDataCache = true;
            $item->DoFuncData($this->__request, $this);
            if ($field_name = $item->getField()) {
                $data->{$field_name} = $this->getFieldValueData($this->{$field_name}, $item, $data->{$field_name});
            }
        }
        if (method_exists($this, 'beforeSave')) {
            $this->beforeSave();
        }
        $data->save();
        $this->refreshData(['module' => $this->module]);
        $this->hideModal();
        $this->ShowMessage('Update successful!');
        $this->ChangeDataEvent();
    }
    public function render()
    {
        $fields = $this->fields;
        if (!$this->flgDataCache) {
            foreach ($fields as $item) {
                $this->flgDataCache = true;
                $item->DoFuncData($this->__request, $this);
            }
        }
        return $this->viewModal($this->getView(), [
            'option' => $this->option,
            'fields' => $fields
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
    public function ChangeDataEvent()
    {
        if ($event = $this->option->getFuncDataChangeEvent()) {
            $event($this->__Params, $this, request());
        }
    }
}
