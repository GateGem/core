<?php

namespace GateGem\Core\Http\Livewire\Common\Filemanager;

use GateGem\Core\Livewire\Modal;

class Index extends Modal
{
    public $disk;
    public $path_current;
    protected function getListeners()
    {
        $listeners = parent::getListeners();
        return [
            ...$listeners,
            'selectPath' => 'eventSelectPath',
        ];
    }
    public function eventSelectPath($path, $local)
    {
        $this->disk = $local;
        $this->path_current = $path;
    }
    public function mount()
    {
        $this->setTitle("File Manager");
        $this->modal_size=Modal::FullscreenXL;
    }
    public function render()
    {
        return $this->viewModal('core::common.filemanager.index');
    }
}
