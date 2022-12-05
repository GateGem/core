<?php

namespace GateGem\Core\Facades;

use Illuminate\Support\Facades\Facade;

/**
 * 
 * @method static mixed addListener(string|array $hook, mixed $callback,int  $priority)
 * @method static \GateGem\Core\Support\Core\ActionHook removeListener(string  $hook)
 * @method static array getListeners()
 * @method static mixed fire(string  $action,array  $args)
 *
 * @see \GateGem\Core\Facades\ActionHook
 */
class Action extends Facade
{
    protected static function getFacadeAccessor()
    {
        return \GateGem\Core\Support\Core\ActionHook::class;
    }
}
