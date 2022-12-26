<?php

namespace GateGem\Core\Http\Livewire\Common\Filemanager;

use GateGem\Core\Facades\GateConfig;
use GateGem\Core\Livewire\Component;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class Folder extends Component
{
    protected function getListeners()
    {
        return [
            ...parent::getListeners(),
            'createFolder' => 'eventCreateFolder'
        ];
    }
    public function eventCreateFolder($name)
    {
        $this->createFolder($name, $this->path_current);
        $this->eventFolderExpand($this->path_current, true);
    }
    public $disk = 'public';
    public $disks = ['local', 'public', 's3'];
    public $folders = [];
    public $path_current;
    public function SelectPath($path)
    {
        $this->path_current = $path;
        $this->folders = collect($this->folders)->map(function ($item) {
            return [
                ...$item,
                'isActive' => $item['value'] == $this->path_current ? 1 : 0
            ];
        })->toArray();
        $this->emitTo('core::common.filemanager', 'selectPath', $this->path_current, $this->disk);
        $this->emitTo('core::common.filemanager.file', 'selectPath', $this->path_current, $this->disk);
    }
    public function mount()
    {
        $this->showFolder('');
        $this->SelectPath('');
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
    public function createFolder($name, $path = '')
    {
        $_path = ($path != '' ? $path . '/' : '') . $name;
        Storage::disk($this->disk)->makeDirectory($_path);
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
                'key' => 'root.' . str_replace('/', '.', str_replace('.', '-', $item))
            ];
        });
    }
    public function eventFolderExpand($value, $show)
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
                    'show' => $show,
                    'isChild' => $this->checkChildInFolder($item['value']),
                ];
            }
            return $item;
        })->toArray();
    }
    private function getOptionTree()
    {
        return GateConfig::Field('abc')
            ->setFuncData(function () {
                return  [
                    [
                        'text' => 'Disk ' . $this->disk,
                        'icon' => '<i class="bi bi-hdd-rack"></i>',
                        'isActive' => 0,
                        'value' => '',
                        'parent' => '',
                        'isChild' => true,
                        'key' => 'root'
                    ],
                    ...$this->folders
                ];
            })->setKeyData('checkBox', false)
            ->setKeyData('icon-open', '<i class="bi bi-folder2-open"></i>')
            ->setKeyData('icon-close', '<i class="bi bi-folder"></i>')
            ->setKeyData('event-expand', 'eventFolderExpand')
            ->setKeyData('skipTop', true)
            ->setKeyData('selectEvent', 'SelectPath')
            ->setKeyData('itemAttr', ' x-on:click="fileSelect = null" ')
            ->DoFuncData(null,null);
    }
    public function render()
    {
        return view('core::common.filemanager.folder', [
            'optionTree' => $this->getOptionTree()
        ]);
    }
}
