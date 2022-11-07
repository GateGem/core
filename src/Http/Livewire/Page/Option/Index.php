<?php

namespace LaraPlatform\Core\Http\Livewire\Page\Option;

use LaraPlatform\Core\Livewire\Modal;
use LaraPlatform\Core\Loader\OptionLoader;

class Index extends Modal
{
    public $data_option;
    public $active_option;
    public function mount()
    {
        $this->data_option = OptionLoader::getData();
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
