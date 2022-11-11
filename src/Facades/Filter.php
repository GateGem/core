<?php

namespace LaraPlatform\Core\Facades;

use Illuminate\Support\Facades\Facade;

/**
 * @see \LaraPlatform\Core\Facades\Filter
 */
class Filter extends Facade
{
    protected static function getFacadeAccessor()
    {
        return \LaraPlatform\Core\Support\Core\FilterHook::class;
    }
}
