<?php

namespace GateGem\Core\Traits;

use Illuminate\Support\Facades\Gate;
use GateGem\Core\Livewire\Modal;
use GateGem\Core\Loader\TableLoader;
use GateGem\Core\Utils\ColectionPaginate;
use Livewire\WithPagination;

trait WithTableIndex
{
    use WithPagination;
    public function mount()
    {
        return $this->LoadData();
    }
    public function queryStringWithPagination()
    {
        foreach ($this->paginators as $key => $value) {
            $this->$key = $value;
        }
        if ($this->modal_isPage) {
            return array_fill_keys(array_keys($this->paginators), ['except' => 1]);
        } else {
            return [];
        }
    }
    protected function getListeners()
    {
        return ['refreshData' . $this->module => '__loadData', 'refreshData' . $this->id => '__loadData'];
    }
    protected $paginationTheme = 'bootstrap';
    protected $isCheckDisableModule = true;
    protected function getView()
    {
        return 'core::common.table.index';
    }
    public $pageSize = 10;
    public $module = '';
    private $option_temp = null;
    public $sort = [];
    public $filter = [];
    public $viewEdit = '';
    public function doSort($field, $sort)
    {
        $this->sort = [];
        if ($sort > -1)
            $this->sort[$field] = $sort;
    }
    public function clearFilter($field = '')
    {
        if ($field) {
            unset($this->filter[$field]);
        } else {
            $this->filter = [];
        }
    }
    public function getOptionProperty()
    {
        if (is_null($this->option_temp)) {
            if (method_exists($this, "getOption")) {
                $option = $this->getOption();
            } else {
                $option = TableLoader::getDataByKey($this->module);
            }
            if (!isset($option['fields'])) $option['fields'] = [];
            $option = apply_filters('filter_table_option_' . $this->module, $option);
            $this->option_temp = $option;

            $this->viewEdit = getValueByKey($option, 'viewEdit', 'core::table.edit');
            if ($option && $this->checkAction()) {
                $option['fields'][] =  [
                    'title' => __(getValueByKey($option, 'action.title', '#')),
                    'classData' => 'action-header',
                    'classHeader' => 'action-data text-center',
                    'funcCell' => function ($row, $column) use ($option) {
                        $html = '';
                        if ($this->checkEdit()) {
                            $html = $html . '<button class="btn btn-sm btn-success" wire:component=\'' . $this->viewEdit . '({"module":"' . $this->module . '","dataId":' . $row[getValueByKey($option, 'modalkey', 'id')] . '})\'><i class="bi bi-pencil-square"></i> <span>' . __('core::table.button.edit') . '</span></button>';
                        }
                        if ($this->checkRemove()) {
                            $html = $html . ' <button class="btn btn-sm btn-danger" data-confirm-message="' . __('core::table.message.confirm-remove') . '" wire:confirm=\'RemoveRow(' .  $row[getValueByKey($option, 'modalkey', 'id')] . ')\'><i class="bi bi-trash"></i> <span>' . __('core::table.button.remove') . '</span></button>';
                        }
                        $buttonAppend = getValueByKey($option, 'action.append', []);
                        foreach ($buttonAppend as $button) {
                            if (getValueByKey($button, 'type', '') == 'update' && (!isset($button['permission']) ||  Gate::check($button['permission']))) {
                                $html = $html . ' <button class="btn btn-sm  ' . getValueByKey($button, 'class', 'btn-danger') . ' " ' .  ($button['action']($row[getValueByKey($option, 'modalkey', 'id')], $row)) . '\'>' . getValueByKey($button, 'icon', '') . ' <span> ' . __(getValueByKey($button, 'title', '')) . ' </span></button>';
                            }
                        }
                        return  $html;
                    }
                ];
            }
            $this->option_temp = $option;
        }
        return  $this->option_temp;
    }
    public function RemoveRow($id)
    {
        $model = app($this->option['model'])->find($id);
        if ($model)
            $model->delete();
        $this->refreshData(['module' => $this->module]);
    }
    public function LoadData()
    {
        $option = $this->option;
        if (!$option || ($this->isCheckDisableModule && getValueByKey($option, 'DisableModule', false)))
            return abort(404);

        if (!$this->modal_isPage) {
            $this->modal_size = getValueByKey($option, 'page_size',  Modal::ExtraLarge);
        }

        $this->setTitle(__(getValueByKey($option, 'title', 'core::tables.' . $this->module . '.title')));
        $this->pageSize = getValueByKey($option, 'pageSize', 10);
        do_action("module_loaddata", $this->module, $this);
        do_action("module_" . $this->module . "_loaddata", $this);
    }
    public function LoadModule($module)
    {
        if (!$module) return abort(404);
        $this->module = $module;
        $this->_code_permission = 'core.' . $this->module;
        if (!$this->checkPermissionView())
            return abort(403);
        $this->LoadData();
    }
    public function getModel()
    {
        if (isset($this->option['model']) && $this->option['model'] != '') {
            $model = app($this->option['model']);
        } else if (isset($this->option['funcData']) && $this->option['funcData'] != '') {
            $model = $this->option['funcData']();
        } else {
            $model = collect([]);
        }
        if (isset($this->option['funcQuery']) && $this->option['funcQuery'] != '') {
            return $this->option['funcQuery']($model, request(), $this);
        }
        return $model;
    }
    public function getData($isAll = false)
    {
        $model = $this->getModel();
        if (method_exists($this, 'getData_before')) {
            $this->getData_before($model);
        }
        do_action("module_getdata_before", $this->module, $this);
        do_action("module_" . $this->module . "_getdata_before", $this, $model);
        foreach ($this->filter as $key => $value) {
            if ($value == '') {
                unset($this->filter[$key]);
            } else {
                $model = $model->where($key, $value);
            }
        }
        if ($model instanceof  \Illuminate\Database\Eloquent\Model) {
            foreach ($this->sort as $key => $value) {
                $model = $model->orderBy($key, $value == 0 ? 'DESC' : 'ASC');
            }
        } else if ($model instanceof \Illuminate\Support\Collection) {
            foreach ($this->sort as $key => $value) {
                if ($value == 0) {
                    $model = $model->sortbydesc($key);
                } else {
                    $model = $model->sortBy($key);
                }
            }
        }


        do_action("module_getdata_after", $this->module, $this);
        do_action("module_" . $this->module . "_getdata_after", $this, $model);
        if ($isAll) {
            return $model->all();
        } else {
            return ColectionPaginate::getPaginate($model, $this->pageSize);
        }
    }
    public function render()
    {
        return $this->viewModal($this->getView(), [
            'data' => $this->getData(),
            'option' => $this->option,
            'viewEdit' => $this->viewEdit,
            'checkAdd' => $this->checkAdd(),
            'checkInportExcel' => $this->checkInportExcel(),
            'checkExportExcel' => $this->checkExportExcel()
        ]);
    }
    private function checkAction()
    {
        if ($this->checkEdit()) return true;
        if ($this->checkRemove()) return true;
        $buttonAppend = getValueByKey($this->getAction(), 'append', []);
        $isAction = false;
        foreach ($buttonAppend as $button) {
            if (getValueByKey($button, 'type', '') == 'update') {
                $isAction = true;
                break;
            }
        }
        return $isAction;
    }
    private function getAction()
    {
        return getValueByKey($this->option_temp, 'action', []);
    }
    public function checkAdd(): bool
    {
        return getValueByKey($this->getAction(), 'add', true) && Gate::check($this->_code_permission . '.add');
    }
    protected function checkEdit()
    {
        return getValueByKey($this->getAction(), 'edit', true) && Gate::check($this->_code_permission . '.edit');
    }
    protected function checkRemove()
    {
        return getValueByKey($this->getAction(), 'delete', true) && Gate::check($this->_code_permission . '.delete');
    }
    protected function checkInportExcel()
    {
        return getValueByKey($this->getAction(), 'inport', true) && Gate::check($this->_code_permission . '.inport');
    }
    protected function checkExportExcel()
    {
        return getValueByKey($this->getAction(), 'export', true) && Gate::check($this->_code_permission . '.export');
    }
}
