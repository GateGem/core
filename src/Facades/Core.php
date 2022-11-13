<?php

namespace LaraIO\Core\Facades;

use Illuminate\Support\Facades\Facade;

/**
 * @see \LaraIO\Core\Facades\Core
 */
class Core extends Facade
{
    protected static function getFacadeAccessor()
    {
        return \LaraIO\Core\Support\Core\CoreManager::class;
    }
}
