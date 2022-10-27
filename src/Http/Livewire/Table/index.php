<?php

namespace LaraPlatform\Core\Http\Livewire\Table;

use LaraPlatform\Core\Livewire\Modal;
use LaraPlatform\Core\Traits\WithTableIndex;

class Index extends Modal
{
    use WithTableIndex;
    public function mount($module)
    {
        $this->LoadModule($module);
    }
}
