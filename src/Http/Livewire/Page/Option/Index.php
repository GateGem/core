<?php

namespace GateGem\Core\Http\Livewire\Page\Option;

use GateGem\Core\Livewire\Modal;
use GateGem\Core\Loader\OptionLoader;
use GateGem\Core\Support\Config\OptionConfig;

class Index extends Modal
{
    public $data_option;
    public $active_option;
    public function mount()
    {
        // $this->_code_permission = 'core.option';
        // if (!$this->checkPermissionView()) abort(403);
        $this->data_option = collect(OptionLoader::getData())->where(function (OptionConfig $item) {
            return $item->getEnable() == true;
        })->toArray();
        usort($this->data_option, function (OptionConfig $a, OptionConfig $b) {
            return strcmp($a->getSort(100), $b->getSort(100));
        });
        $this->active_option = $this->data_option[0]->getKey();
        $this->setTitle(__('core::menu.sidebar.option'));
    }
    public function render()
    {
        return $this->viewModal('core::page.option.index');
    }
}
