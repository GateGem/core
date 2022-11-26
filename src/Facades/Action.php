<?php

namespace LaraIO\Core\Facades;

use Illuminate\Support\Facades\Facade;

/**
 * 
 * @method static mixed addListener(string|array $hook, mixed $callback,int  $priority)
 * @method static \LaraIO\Core\Support\Core\ActionHook removeListener(string  $hook)
 * @method static array getListeners()
 * @method static mixed fire(string  $action,array  $args)
 *
 * @see \LaraIO\Core\Facades\ActionHook
 */
class Action extends Facade
{
    protected static function getFacadeAccessor()
    {
        return \LaraIO\Core\Support\Core\ActionHook::class;
    }
}
