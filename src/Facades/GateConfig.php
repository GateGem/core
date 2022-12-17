<?php

namespace GateGem\Core\Facades;

use Illuminate\Support\Facades\Facade;

/**
 * 
 * @method static void setFields($fields = [])
 * @method static void setForm($form)
 * @method static void setModel(string $model)
 * @method static void setModelKey(string $key)
 * @method static void setTitle(string $title)
 * @method static void disableModule(bool $flg)
 * @method static void setFuncQuery(callable $callback)
 * @method static \GateGem\Core\Support\Config\FieldConfig Field($field='')
 * @method static \GateGem\Core\Support\Config\FormConfig Form()
 * @method static \GateGem\Core\Support\Config\ConfigManager NewItem($title='')
 * 
 * 
 * 
 * @see \GateGem\Core\Facades\GateConfig
 */
class GateConfig extends Facade
{
    protected static function getFacadeAccessor()
    {
        return \GateGem\Core\Support\Config\ConfigManager::class;
    }
}
