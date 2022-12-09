<?php

namespace GateGem\Core\Http\Livewire\Common\Filemanager;

use GateGem\Core\Livewire\Component;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;

class File extends Component
{
    public $disk;
    public $path_current;
    public $files;
    protected function getListeners()
    {
        $listeners = parent::getListeners();
        return [
            ...$listeners,
            'selectPath' => 'eventSelectPath',
            'uploadFile' => 'eventUploadFile'
        ];
    }
    public function eventSelectPath($path, $local)
    {
        $this->disk = $local;
        $this->path_current = $path;
        $this->refreshFolder();
    }
    public function eventUploadFile($file)
    {
        Log::info($file);
    }
    public function refreshFolder()
    {
        $this->files = Storage::disk($this->disk)->files($this->path_current);
    }
    public function mount()
    {
    }
    public function render()
    {
        return view('core::common.filemanager.file');
    }
}
