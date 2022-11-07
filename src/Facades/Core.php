<?php

namespace LaraPlatform\Core\Facades;

use Illuminate\Support\Facades\Facade;

/**
 * @see \LaraPlatform\Core\Facades\Core
 */
class Core extends Facade
{
    protected static function getFacadeAccessor()
    {
        return \LaraPlatform\Core\Supports\CoreManager::class;
    }
}
