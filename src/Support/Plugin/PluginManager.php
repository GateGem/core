<?php

namespace LaraIO\Core\Support\Plugin;

use LaraIO\Core\Traits\WithLoadInfoJson;

class PluginManager
{
    use WithLoadInfoJson;
    public function getName()
    {
        return "plugin";
    }
}
