<?php

namespace LaraPlatform\Core\Http\Livewire\Common\Option;

use LaraPlatform\Core\Livewire\Modal;

class Index extends Modal
{
    public function mount($module, $dataId = null)
    {
        $this->LoadModule($module, $dataId);
    }
}
