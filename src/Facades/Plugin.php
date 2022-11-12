<?php

namespace LaraPlatform\Core\Facades;

use Illuminate\Support\Facades\Facade;

/**
 * @see \LaraPlatform\Core\Facades\Plugin
 */
class Plugin extends Facade
{
    protected static function getFacadeAccessor()
    {
        return \LaraPlatform\Core\Support\Plugin\PluginManager::class;
    }
}
