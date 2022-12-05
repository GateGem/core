<?php

namespace GateGem\Core\Http\Livewire\Table;

use GateGem\Core\Livewire\Modal;
use GateGem\Core\Traits\WithTableIndex;

class Index extends Modal
{
    use WithTableIndex;
    public function mount($module)
    {
        $this->LoadModule($module);
    }
}