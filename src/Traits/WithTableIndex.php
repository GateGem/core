<?php

namespace LaraPlatform\Core\Traits;

use Illuminate\Support\Facades\Gate;
use LaraPlatform\Core\Livewire\Modal;
use LaraPlatform\Core\Loader\TableLoader;
use Livewire\WithPagination;

trait WithTableIndex
{
    use WithPagination;
    public function queryStringWithPagination()
    {
        foreach ($this->paginators as $key => $value) {
            $this->$key = $value;
        }
        if ($this->isPage) {
            return array_fill_keys(array_keys($this->paginators), ['except' => 1]);
        } else {
            return [];
        }
    }
    protected function getListeners()
    {
        return ['refreshData' . $this->module => 'loadData'];
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
            $option = TableLoader::getDataByKey($this->module);
            if (!isset($option['fields'])) $option['fields'] = [];
            $this->option_temp = $option;
            $this->viewEdit = getValueByKey($option, 'viewEdit', 'devhau-module::admin.table.edit');
            if ($option && $this->checkAction()) {
                $option['fields'][] =  [
                    'title' => getValueByKey($option, 'action.title', '#'),
                    'classData' => 'action-header',
                    'classHeader' => 'action-data text-center',
                    'funcCell' => function ($row, $column) use ($option) {
                        $html = '';
                        if ($this->checkEdit()) {
                            $html = $html . '<button class="btn btn-sm btn-success" wire:openmodal=\'' . $this->viewEdit . '({"module":"' . $this->module . '","dataId":' . $row[getValueByKey($option, 'modalkey', 'id')] . '})\'><i class="bi bi-pencil-square"></i> <span>Sửa</span></button>';
                        }
                        if ($this->checkRemove()) {
                            $html = $html . ' <button class="btn btn-sm btn-danger" data-confirm-message="bạn có muốn xóa không?" wire:confirm=\'RemoveRow(' .  $row[getValueByKey($option, 'modalkey', 'id')] . ')\'><i class="bi bi-trash"></i> <span>Xóa</span></button>';
                        }
                        $buttonAppend = getValueByKey($option, 'action.append', []);
                        foreach ($buttonAppend as $button) {
                            if (getValueByKey($button, 'type', '') == 'update' && (!isset($button['permission']) || Gate::check($button['permission']))) {
                                $html = $html . ' <button class="btn btn-sm  ' . getValueByKey($button, 'class', 'btn-danger') . ' " ' .  ($button['action']($row[getValueByKey($option, 'modalkey', 'id')], $row)) . '\'>' . getValueByKey($button, 'icon', '') . ' <span> ' . getValueByKey($button, 'title', '') . ' </span></button>';
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
    public function LoadModule($module)
    {
        if (!$module) return abort(404);
        $this->module = $module;
        $this->code_permission = "admin." . $this->module;
        $option = $this->option;
        if (!$option || ($this->isCheckDisableModule && getValueByKey($option, 'DisableModule', false)))
            return abort(404);

        if (!$this->isPage) {
            $this->sizeModal = getValueByKey($option, 'sizeModal',  Modal::ExtraLarge);
        }
        $this->setTitle(getValueByKey($option, 'title', ''));
        $this->pageSize = getValueByKey($option, 'pageSize', 10);
    }
    public function getData($isAll = false)
    {
        $model = app($this->option['model']);
        foreach ($this->filter as $key => $value) {
            if ($value == '') {
                unset($this->filter[$key]);
            } else {
                $model = $model->where($key, $value);
            }
        }
        foreach ($this->sort as $key => $value) {
            $model = $model->orderBy($key, $value == 0 ? 'DESC' : 'ASC');
        }
        if ($isAll) {
            return $model->all();
        } else {
            return $model->paginate($this->pageSize);
        }
    }
    public function render()
    {
        return $this->viewModal($this->getView(), null, null, [
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
        return getValueByKey($this->getAction(), 'add', true) && Gate::check($this->code_permission . '.add');
    }
    protected function checkEdit()
    {
        return getValueByKey($this->getAction(), 'edit', true) && Gate::check($this->code_permission . '.edit');
    }
    protected function checkRemove()
    {
        return getValueByKey($this->getAction(), 'delete', true) && Gate::check($this->code_permission . '.delete');
    }
    protected function checkInportExcel()
    {
        return getValueByKey($this->getAction(), 'inport', true) && Gate::check($this->code_permission . '.inport');
    }
    protected function checkExportExcel()
    {
        return getValueByKey($this->getAction(), 'export', true) && Gate::check($this->code_permission . '.export');
    }
}
