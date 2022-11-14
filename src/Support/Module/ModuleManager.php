<?php

namespace LaraIO\Core\Support\Module;

use LaraIO\Core\Traits\WithLoadInfoJson;

class ModuleManager
{
    use WithLoadInfoJson;
    public function FileInfoJson()
    {
        return "module.json";
    }
    public function HookFilterPath()
    {
        return 'module_root_path';
    }
    public function PathFolder()
    {
        return module_path();
    }
    public function PublicFolder(){
        return public_path('modules');
    }
}
