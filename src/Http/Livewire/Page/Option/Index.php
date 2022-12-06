<?php

namespace GateGem\Core\Http\Livewire\Page\Option;

use GateGem\Core\Livewire\Modal;
use GateGem\Core\Loader\OptionLoader;

class Index extends Modal
{
    public $data_option;
    public $active_option;
    public function mount()
    {
        // $this->_code_permission = 'core.option';
        // if (!$this->checkPermissionView()) abort(403);
        $this->data_option = collect(OptionLoader::getData())->where(function ($item) {
            if (isset($item['enable']) && $item['enable'] == false) return false;
            return true;
        })->toArray();
        usort($this->data_option, function ($a, $b) {
            $sortA = getValueByKey($a, 'sort', 100);
            $sortB = getValueByKey($b, 'sort', 100);
            return strcmp($sortA, $sortB);
        });
        $this->active_option = array_keys($this->data_option)[0];
        $this->setTitle(__('core::menu.sidebar.option'));
    }
    public function render()
    {
        return $this->viewModal('core::page.option.index');
    }
}
