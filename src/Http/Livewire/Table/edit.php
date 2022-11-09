<?php

namespace LaraPlatform\Core\Http\Livewire\Table;

use LaraPlatform\Core\Livewire\Modal;
use LaraPlatform\Core\Traits\WithTableEdit;

class Edit extends Modal
{
    use WithTableEdit;
    public function mount($module, $dataId = null)
    {
        $this->LoadModule($module, $dataId);
    }
}
