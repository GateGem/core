<?php

namespace LaraIO\Core\Support\Plugin;

use LaraIO\Core\Traits\WithLoadInfoJson;

class PluginManager
{
    use WithLoadInfoJson;
    public function FileInfoJson()
    {
        return "plugin.json";
    }
    public function HookFilterPath()
    {
        return 'plugin_root_path';
    }
    public function PathFolder()
    {
        return plugin_path();
    }
}
