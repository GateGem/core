<?php

namespace GateGem\Core\Http\Livewire\Common\Filemanager;

use GateGem\Core\Livewire\Modal;

class InputName extends Modal
{
    public $inputName;
    public $inputNameOld;
    public function mount()
    {
    }
    public function DoWork()
    {
        $this->emitTo('core::common.filemanager.folder', 'createFolder', $this->inputName);
        $this->hideModal();
    }
    public function render()
    {
        return $this->viewModal('core::common.filemanager.inputname');
    }
}
