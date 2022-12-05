<?php

namespace GateGem\Core\Http\Livewire\Table;

use GateGem\Core\Livewire\Modal;
use GateGem\Core\Traits\WithTableEdit;

class Edit extends Modal
{
    use WithTableEdit;
    public function mount($module, $dataId = null)
    {
        $this->LoadModule($module, $dataId);
    }
}
