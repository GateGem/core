<?php

namespace GateGem\Core\Http\Livewire\Common\Filemanager;

use GateGem\Core\Livewire\Component;

class File extends Component
{
    protected function getListeners(){
        $listeners= parent::getListeners();
        return [
            ...$listeners,
            'showFile'=>'eventShowFileInPath'
        ];
    }
    public function eventShowFileInPath($path,$local){

    }
    public function mount()
    {
    }
    public function render()
    {
        return view('core::common.filemanager.file');
    }
}
