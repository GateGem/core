<?php

namespace LaraIO\Core\Facades;

use Illuminate\Support\Facades\Facade;

/**
 * @see \LaraIO\Core\Facades\Module
 */
class Module extends Facade
{
    protected static function getFacadeAccessor()
    {
        return \LaraIO\Core\Support\Module\ModuleManager::class;
    }
}
