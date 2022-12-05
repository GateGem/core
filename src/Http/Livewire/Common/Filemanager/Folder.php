<?php

namespace GateGem\Core\Http\Livewire\Common\Filemanager;

use GateGem\Core\Livewire\Component;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class Folder extends Component
{
    public $disk = 'public';
    public $disks = ['local', 'public', 's3'];
    public $folders = [];
    public function mount()
    {
        //  $this->folders = $this->getFolder('xin-chao3')->toArray();
        $this->showFolder('');
        // $this->hideFolder('');
    }
    public function treeFolder($path)
    {
        $this->showFolder($path, function ($folder) {
            $this->treeFolder($folder['value']);
        });
    }
    public function hideFolder($path)
    {
        $this->folders = collect($this->folders)->where(function ($item) use ($path) {
            if (($item['value'] != $path && Str::startsWith($item['value'], $path . '/')) || $path == '') {
                return false;
            }
            return true;
        })->toArray();
    }
    public function showFolder($path, $callback = null)
    {
        $folders = $this->getFolder($path)->toArray();
        if (count($folders) > 0) {
            foreach ($folders as $folder) {
                $this->folders[] = $folder;
                if ($callback) {
                    $callback($folder);
                }
            }
        }
    }
    public function checkChildInFolder($path)
    {
        return count(Storage::disk($this->disk)->directories($path)) > 0;
    }
    public function getFolder($path)
    {
        return collect(Storage::disk($this->disk)->directories($path))->map(function ($item) use ($path) {
            return [
                'text' => basename($item),
                'value' => $item,
                'parent' => $path,
                'isChild' => $this->checkChildInFolder($item),
                'key' => 'root.' . str_replace('/', '.', $item)
            ];
        });
    }
    public function TestEventExpand($value, $show)
    {
        if ($show) {
            $this->showFolder($value);
        } else {
            $this->hideFolder($value);
        }
        $this->folders = collect($this->folders)->map(function ($item) use ($value, $show) {
            if ($value == $item['value']) {
                return [
                    ...$item,
                    'show' => $show
                ];
            }
            return $item;
        })->toArray();
    }
    private function getOptionTree()
    {
        return [
            'field' => 'abc',
            'funcData' => $this->folders,
            'event-expand' => 'TestEventExpand'
        ];
    }
    public function render()
    {
        return view('core::common.filemanager.folder', [
            'optionTree' => $this->getOptionTree()
        ]);
    }
}
