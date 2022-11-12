<?php

namespace LaraPlatform\Core\Facades;

use Illuminate\Support\Facades\Facade;

/**
 * @see \LaraPlatform\Core\Facades\Module
 */
class Module extends Facade
{
    protected static function getFacadeAccessor()
    {
        return \LaraPlatform\Core\Support\Module\ModuleManager::class;
    }
}
