<?php

namespace LaraPlatform\Core\Http\Livewire\Page\Option;

use LaraPlatform\Core\Livewire\Modal;

class Index extends Modal
{
    public function render()
    {
        return $this->viewModal('core::page.option.index');
    }
}