<?php

namespace LaraIO\Core\Http\Livewire\Table;

use LaraIO\Core\Livewire\Modal;
use LaraIO\Core\Traits\WithTableEdit;

class Edit extends Modal
{
    use WithTableEdit;
    public function mount($module, $dataId = null)
    {
        $this->LoadModule($module, $dataId);
    }
}
