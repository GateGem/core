<?php

namespace GateGem\Core\Facades;

use Illuminate\Support\Facades\Facade;

/**
 * 
 * @method static string getName()
 * @method static string FileInfoJson()
 * @method static string HookFilterPath()
 * @method static string PathFolder()
 * @method static string getPath(string $path)
 * @method static string PublicFolder()
 * @method static void LoadApp()
 * @method static void RegisterApp()
 * @method static void BootApp()
 * @method static \Illuminate\Support\Collection<string, \GateGem\Core\Support\Core\DataInfo> getData()
 * @method static \GateGem\Core\Support\Core\DataInfo find(string $name)
 * @method static bool has(string $name)
 * @method static void delete(string $name)
 * @method static void Load(string $path)
 * @method static void AddItem(string $path)
 * @method static string getUsed()
 * @method static void forgetUsed()
 * @method static void setUsed(string $name)
 * @method static void update(string $name)
 *
 * @see \GateGem\Core\Facades\Plugin
 */
class Plugin extends Facade
{
    protected static function getFacadeAccessor()
    {
        return \GateGem\Core\Support\Plugin\PluginManager::class;
    }
}
