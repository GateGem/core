<?php

namespace LaraPlatform\Core\Http\Livewire\Table;

use LaraPlatform\Core\Livewire\Modal;

class edit extends Modal
{
    public function render()
    {
        return $this->viewModal('core::page.dashboard.index');
    }
}
