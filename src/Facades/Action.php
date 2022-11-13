<?php

namespace LaraIO\Core\Facades;

use Illuminate\Support\Facades\Facade;

/**
 * @see \LaraIO\Core\Facades\Action
 */
class Action extends Facade
{
    protected static function getFacadeAccessor()
    {
        return \LaraIO\Core\Support\Core\ActionHook::class;
    }
}
