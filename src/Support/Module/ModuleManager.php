<?php

namespace LaraIO\Core\Support\Module;

use LaraIO\Core\Traits\WithLoadInfoJson;

class ModuleManager
{
    use WithLoadInfoJson;
    public function getName()
    {
        return "module";
    }
}
