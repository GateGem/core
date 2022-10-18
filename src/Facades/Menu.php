<?php

namespace LaraPlatform\Core\Facades;

use Illuminate\Support\Facades\Facade;

/**
 * @see \LaraPlatform\Core\Facades\Action
 */
class Menu extends Facade
{
    protected static function getFacadeAccessor()
    {
        return \LaraPlatform\Core\Supports\MenuManager::class;
    }
}
