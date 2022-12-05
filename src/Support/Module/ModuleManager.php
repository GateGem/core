<?php

namespace GateGem\Core\Support\Module;

use GateGem\Core\Traits\WithLoadInfoJson;

class ModuleManager
{
    use WithLoadInfoJson;
    public function getName()
    {
        return "module";
    }
}
