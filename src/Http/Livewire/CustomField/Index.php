<?php

namespace GateGem\Core\Http\Livewire\CustomField;

use GateGem\Core\Livewire\Modal;

class Index extends Modal
{
    public function mount()
    {
        $this->setTitle('test');
        $this->modal_size = Modal::ExtraLarge;
    }
    public function render()
    {
        return $this->viewModal('core::custom-field.index');
    }
}
