<?php

namespace GateGem\Core\Http\Livewire\Common\Filemanager;

use GateGem\Core\Facades\Core;
use GateGem\Core\Livewire\Component;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;

class File extends Component
{
    public $disk = 'public';
    public $path_current = '';
    public $files = [];
    protected function getListeners()
    {
        return Core::mereArr(parent::getListeners(), [
            'selectPath' => 'eventSelectPath',
            'uploadFile' => 'eventUploadFile'
        ]);
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
        $this->files = collect(Storage::disk($this->disk)->files($this->path_current))->map(function ($pathFile) {
            return Core::mereArr(
                get_file_info(Storage::disk($this->disk)->path($pathFile)),
                [
                    'url' => Storage::disk($this->disk)->url($pathFile)
                ]
            );
        })->toArray();
    }
    public function mount()
    {
        $this->refreshFolder();
    }
    public function render()
    {
        return view('core::common.filemanager.file');
    }
}
