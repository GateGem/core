<?php

namespace LaraPlatform\Core\Traits;

use LaraPlatform\Core\Utils\BaseScan;

trait WithLoadInfoJson
{
    private $arrData = [];
    public function FileInfoJson()
    {
        return "info.json";
    }
    public function HookFilterPath()
    {
        return 'info_path';
    }
    public function PathFolder()
    {
        return '';
    }
    public function Boot()
    {
        $this->Register(apply_filters($this->HookFilterPath(), $this->PathFolder()));
    }
    public function getData()
    {
        return collect($this->arrData);
    }


    public function Register($path)
    {
        if ($files = BaseScan::AllFolder($path)) {
            foreach ($files as $item) {
                $this->AddItem($item);
            }
        }
    }
    public function AddItem($path)
    {
        $this->arrData[] = [
            ...BaseScan::FileJson($path . '/' . $this->FileInfoJson()),
            'path' => $path
        ];
    }
}
