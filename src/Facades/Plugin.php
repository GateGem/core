<?php

namespace LaraIO\Core\Facades;

use Illuminate\Support\Facades\Facade;

/**
 * @see \LaraIO\Core\Facades\Plugin
 */
class Plugin extends Facade
{
    protected static function getFacadeAccessor()
    {
        return \LaraIO\Core\Support\Plugin\PluginManager::class;
    }
}
