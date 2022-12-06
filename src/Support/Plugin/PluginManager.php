<?php

namespace GateGem\Core\Support\Plugin;

use GateGem\Core\Traits\WithSystemExtend;

class PluginManager
{
    use WithSystemExtend;
    public function getName()
    {
        return "plugin";
    }
}
