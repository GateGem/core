<?php

namespace LaraPlatform\Core\Facades;

use Illuminate\Support\Facades\Facade;

/**
 * @see \LaraPlatform\Core\Facades\Theme
 */
class Theme extends Facade
{
    protected static function getFacadeAccessor()
    {
        return \LaraPlatform\Core\Supports\ThemeManager::class;
    }
}
