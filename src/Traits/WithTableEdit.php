<?php

namespace LaraPlatform\Core\Traits;

use LaraPlatform\Core\Livewire\Modal;
use LaraPlatform\Core\Loader\TableLoader;
use Livewire\WithFileUploads;

trait WithTableEdit
{
    use WithFileUploads;
    public $module = '';
    public $dataId = 0;
    public $isFormNew = true;
    public $rules = [];
    protected function getView()
    {
        return 'core::common.table.edit';
    }
    public function getOptionProperty()
    {
        return TableLoader::getDataByKey($this->module);
    }
    public function getFieldsProperty()
    {
        return  getValueByKey($this->getOptionProperty(), 'fields', []);
    }
    public function LoadModule($module, $dataId = null)
    {
        $this->dataId = $dataId;
        if (!$module) return abort(404);
        $this->module = $module;
        $option = $this->getOptionProperty();
        if (!$option || !isset($option['model']) || $option['model'] == '')
            return abort(404);

        if (!$this->modal_isPage) {
            $this->sizeModal = getValueByKey($option, 'formSize',  Modal::FullscreenMd);
        }
        $this->setTitle(getValueByKey($option, 'title', ''));
        $fields = $this->getFieldsProperty();
        $data = null;
        if ($this->dataId) {
            // edit
            $data = app($option['model'])->find($this->dataId);
            if (!$data)
                return abort(404);
            $this->isFormNew = false;
        } else {
            // new
            $data = new (app($option['model']));
        }
        foreach ($fields as $item) {
            if (isset($item['field']) && $item['field'] != '') {
                if (isset($data->{$item['field']}))
                    $this->{$item['field']} = $data->{$item['field']};
                else {
                    if ($this->isFormNew) {
                        $this->{$item['field']} = getValueByKey($item, 'default', '');
                    } else {
                        $this->{$item['field']} = '';
                    }
                }
            }
        }
        $fnRule = getValueByKey($option, 'formRule', null);
        if ($fnRule) {
            $this->rules = $fnRule($dataId, $this->isFormNew) ?? [];
        }
    }
    public function SaveForm()
    {
        if ($this->rules && count($this->rules) > 0)
            $this->validate();

        $option = $this->getOptionProperty();
        $data = null;
        if ($this->dataId) {
            // edit
            $data = app($option['model'])->find($this->dataId);
            if (!$data)
                return abort(404);
            $this->isFormNew = false;
        } else {
            // new
            $data = new (app($option['model']));
        }
        $fields = $this->getFieldsProperty();
        if (method_exists($this, 'beforeBinding')) {
            $this->beforeBinding();
        }
        foreach ($fields as $item) {
            if (isset($item['field']) && $item['field'] != '') {
                $valuePreview = $this->{$item['field']};
                if (is_object($valuePreview)) {
                    $valuePreview = $valuePreview->store('public');
                    $valuePreview = str_replace('public', 'storage', $valuePreview);
                }
                $data->{$item['field']} =  $valuePreview;
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
