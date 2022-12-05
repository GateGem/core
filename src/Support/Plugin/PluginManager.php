<?php

namespace GateGem\Core\Support\Plugin;

use GateGem\Core\Traits\WithLoadInfoJson;

class PluginManager
{
    use WithLoadInfoJson;
    public function getName()
    {
        return "plugin";
    }
}
