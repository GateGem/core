<?php

namespace GateGem\Core\Http\Livewire\Common\Filemanager;

use GateGem\Core\Livewire\Modal;

class Index extends Modal
{
    public function mount()
    {
    }
    public function render()
    {
        return $this->viewModal('core::common.filemanager.index');
    }
}
