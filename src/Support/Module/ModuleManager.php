<?php

namespace GateGem\Core\Support\Module;

use GateGem\Core\Traits\WithSystemExtend;

class ModuleManager
{
    use WithSystemExtend;
    public function getName()
    {
        return "module";
    }
}
