<?php

namespace LaraIO\Core\Traits;

use LaraIO\Core\Support\Core\DataInfo;
use LaraIO\Core\Utils\BaseScan;

trait WithLoadInfoJson
{
    public function __construct()
    {
        $this->arrData = collect([]);
    }
    private $arrData = [];
    public function getName()
    {
        return 'info';
    }
    public function FileInfoJson()
    {
        return $this->getName() . ".json";
    }
    public function HookFilterPath()
    {
        return $this->getName() . '_path';
    }
    public function PathFolder()
    {
        return path_by($this->getName());
    }
    public function PublicFolder()
    {
        return public_path($this->getName() . 's');
    }
    public function Boot()
    {
        $this->Register(apply_filters($this->HookFilterPath(), $this->PathFolder()));
    }
    /**
     * Get the data.
     *
     * @return \Illuminate\Support\Collection<string, \LaraIO\Core\Support\Core\DataInfo>
     */
    public function getData()
    {
        return $this->arrData;
    }
    /**
     * Find item by name.
     * @param string $name
     *
     * @return  \LaraIO\Core\Support\Core\DataInfo
     */
    public function find($name)
    {
        return $this->getData()->where(function (\LaraIO\Core\Support\Core\DataInfo $item) use ($name) {
            return $item->CheckName($name);
        })->first();
    }
    public function has($name)
    {
        return $this->find($name) != null;
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
        $this->arrData[$path] = new DataInfo($path, $this->FileInfoJson(), $this->PublicFolder());
    }
}
