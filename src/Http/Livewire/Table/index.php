<?php

namespace LaraIO\Core\Http\Livewire\Table;

use LaraIO\Core\Livewire\Modal;
use LaraIO\Core\Traits\WithTableIndex;

class Index extends Modal
{
    use WithTableIndex;
    public function mount($module)
    {
        $this->LoadModule($module);
    }
}
