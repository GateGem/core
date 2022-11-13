<?php

namespace LaraIO\Core\Facades;

use Illuminate\Support\Facades\Facade;

/**
 * @see \LaraIO\Core\Facades\Theme
 */
class Theme extends Facade
{
    protected static function getFacadeAccessor()
    {
        return \LaraIO\Core\Support\Theme\ThemeManager::class;
    }
}
