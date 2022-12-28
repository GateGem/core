<?php

namespace GateGem\Core\Traits;

use GateGem\Core\Facades\Core;
use GateGem\Core\Facades\GateConfig;
use GateGem\Core\Livewire\Modal;
use GateGem\Core\Loader\TableLoader;
use GateGem\Core\Support\Config\ButtonConfig;
use GateGem\Core\Support\Config\ConfigManager;
use GateGem\Core\Support\Config\FormConfig;
use GateGem\Core\Utils\ColectionPaginate;
use Livewire\WithPagination;

trait WithTableIndex
{
    use WithPagination;
    use \Livewire\WithFileUploads;
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
        return Core::mereArr(parent::getListeners(), [
            'refreshData' . $this->module => '__loadData',
            'EventTableUpdate' => 'EventTableUpdate'
        ]);
    }
    protected $paginationTheme = 'bootstrap';
    protected $isCheckDisableModule = true;
    protected function getView()
    {
        return 'core::table.index';
    }
    public function EventTableUpdate($name, $value)
    {
        $this->{$name} = $value;
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
    public function getOptionProperty(): ConfigManager| null
    {
        if (is_null($this->option_temp)) {
            if (method_exists($this, "getOption")) {
                $option = $this->getOption();
            } else {
                $option = TableLoader::getDataByKey($this->module);
            }
            if ($option == null || !is_a($option, ConfigManager::class)) {
                return null;
            }

            $option = apply_filters('filter_table_option_' . $this->module, $option);
            $this->option_temp = $option;

            $this->viewEdit = getValueByKey($option, FormConfig::FORM_EDIT, 'core::table.edit');
            if ($option) {
                $option[ConfigManager::FIELDS][] = GateConfig::Field('')
                    ->setTitle(getValueByKey($option, ConfigManager::ACTION_TITLE, '#'))
                    ->setCheckShow(function () {
                        return $this->checkAction();
                    })
                    ->setClassData('action-data  text-center')
                    ->setClassHeader('action-header text-center')
                    ->setFuncCell(function ($valueCell, $row, $column) use ($option) {
                        $html = '';
                        $valueId = $row[getValueByKey($option, ConfigManager::MODEL_KEY, 'id')];
                        if ($this->checkEdit()) {
                            $html = $html  . "&nbsp;" . GateConfig::Button('core::table.button.edit')
                                ->setClass('btn btn-sm btn-success')
                                ->setDoComponent($this->viewEdit, "{'module':'" . $this->module . "','dataId':" . $valueId . '}')
                                ->setIcon('<i class="bi bi-pencil-square"></i> ')
                                ->toHtml();
                        }
                        if ($this->checkRemove()) {
                            $html = $html . "&nbsp;" . GateConfig::Button('core::table.button.remove')
                                ->setClass('btn btn-sm btn-danger')
                                ->setAttr(' data-confirm-message="' . __('core::table.message.confirm-remove') . '" ')
                                ->setConfirm('RemoveRow', "{'module':'" . $this->module . "','dataId':" . $valueId . '}')
                                ->setIcon('<i class="bi bi-trash"></i> ')
                                ->toHtml();
                        }

                        $buttonAppend = getValueByKey($option, ConfigManager::BUTTON_APPEND, []);
                        foreach ($buttonAppend as $button) {
                            if ($button->checkType(ButtonConfig::TYPE_UPDATE)) {
                                $html = $html . "&nbsp;" .  $button->toHtml($valueId, $row, $column);
                            }
                        }
                        return  $html;
                    });
                foreach ($option[ConfigManager::FIELDS] as $item) {
                    $item->DoFuncData($this->__request, $this);
                }
            }
            $this->option_temp = $option;
        }
        return  $this->option_temp;
    }
    public function RemoveRow($id)
    {
        $model = app($this->option[ConfigManager::MODEL])->find($id);
        if ($model)
            $model->delete();
        $this->refreshData(['module' => $this->module]);
    }
    public function LoadData()
    {
        $option = $this->option;
        if (!$option || ($this->isCheckDisableModule && !$option->getEnable()))
            return abort(404);

        if (!$this->modal_isPage) {
            $this->modal_size = $option->getValueInForm(FormConfig::FORM_SIZE, Modal::Large);
        }

        $this->setTitle(__($option->getTitle('core::tables.' . $this->module . '.title')));
        $this->pageSize = $option->getPageSize(10);
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
        if ($this->option == null) return abort(404);
        $this->LoadData();
    }
    public function getModel()
    {
        if (isset($this->option[ConfigManager::MODEL])) {
            $model = app($this->option[ConfigManager::MODEL]);
        } else if (isset($this->option[ConfigManager::FUNC_DATA])) {
            $model = $this->option[ConfigManager::FUNC_DATA]();
        } else {
            $model = collect([]);
        }
        if (isset($this->option[ConfigManager::FUNC_QUERY])) {
            return $this->option[ConfigManager::FUNC_QUERY]($model, request(), $this);
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
        if (getValueByKey($this->option, ConfigManager::FUNC_FILTER)) {
            $model = getValueByKey($this->option, ConfigManager::FUNC_FILTER)($model, $this->filter, $this);
        } else {
            foreach ($this->filter as $key => $value) {
                if ($value == '') {
                    unset($this->filter[$key]);
                } else {
                    $model = $model->where($key, $value);
                }
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
        $buttonAppend = $this->getKeyData(ConfigManager::BUTTON_APPEND, []);
        $isAction = false;
        foreach ($buttonAppend as $button) {
            if ($button->checkType(ButtonConfig::TYPE_UPDATE)) {
                $isAction = true;
                break;
            }
        }
        return $isAction;
    }
    public function getKeyData($key, $default = '')
    {
        if (isset($this->option[$key])) return $this->option[$key];
        return $default;
    }
    public function checkAdd(): bool
    {
        return $this->getKeyData(ConfigManager::ACTION_ADD, true) && \GateGem\Core\Facades\Core::checkPermission($this->_code_permission . '.add');
    }
    protected function checkEdit()
    {
        return $this->getKeyData(ConfigManager::ACTION_EDIT, true) && \GateGem\Core\Facades\Core::checkPermission($this->_code_permission . '.edit');
    }
    protected function checkRemove()
    {
        return $this->getKeyData(ConfigManager::ACTION_REMOVE, true) && \GateGem\Core\Facades\Core::checkPermission($this->_code_permission . '.delete');
    }
    protected function checkInportExcel()
    {
        return $this->getKeyData(ConfigManager::INPORT_EXCEL, true) && \GateGem\Core\Facades\Core::checkPermission($this->_code_permission . '.inport');
    }
    protected function checkExportExcel()
    {
        return $this->getKeyData(ConfigManager::EXPORT_EXCEL, true) && \GateGem\Core\Facades\Core::checkPermission($this->_code_permission . '.export');
    }
}
