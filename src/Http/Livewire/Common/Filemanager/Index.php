<?php

namespace LaraIO\Core\Http\Livewire\Common\Filemanager;

use LaraIO\Core\Livewire\Modal;

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
