<?php

namespace LaraPlatform\Core\Support\Module;

use LaraPlatform\Core\Traits\WithLoadInfoJson;

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
}
