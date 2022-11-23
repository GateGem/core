<?php

namespace LaraIO\Core\Traits;

use LaraIO\Core\Facades\Core;
use LaraIO\Core\Support\Core\DataInfo;

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
        return $this->getPath('');
    }
    public function getPath($path)
    {
        return path_by($this->getName(), $path);
    }
    public function PublicFolder()
    {
        return public_path($this->getName() . 's');
    }
    public function RegisterApp()
    {
        $this->Register(apply_filters($this->HookFilterPath(), $this->PathFolder()));
    }
    public function BootApp()
    {
        $name = $this->getName();
        foreach ($this->getData() as $item) {
            if ($item->isActive()) {
                $item->DoBoot();
            }
        }
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
    public function delete($name)
    {
        $base = $this->find($name);
        if ($base) {
            $base->delete();
        }
    }
    public function Register($path)
    {
        if ($files = Core::AllFolder($path)) {
            foreach ($files as $item) {
                $this->AddItem($item);
            }
        }
    }
    public function AddItem($path)
    {
        $this->arrData[$path] = new DataInfo($path, $this);
        if ($this->arrData[$path]->isActive())
            $this->arrData[$path]->DoRegister();
        return $this->arrData[$path];
    }
}
