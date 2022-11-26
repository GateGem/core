<?php

namespace LaraIO\Core\Facades;

use Illuminate\Support\Facades\Facade;

/**
 * 
 * @method static string getName()
 * @method static string FileInfoJson()
 * @method static string HookFilterPath()
 * @method static string PathFolder()
 * @method static string getPath(string $path)
 * @method static string PublicFolder()
 * @method static void RegisterApp()
 * @method static void BootApp()
 * @method static \Illuminate\Support\Collection<string, \LaraIO\Core\Support\Core\DataInfo> getData()
 * @method static \LaraIO\Core\Support\Core\DataInfo find(string $name)
 * @method static bool has(string $name)
 * @method static void delete(string $name)
 * @method static void Register(string $path)
 * @method static void AddItem(string $path)
 *
 * @see \LaraIO\Core\Facades\Theme
 */
class Theme extends Facade
{
    protected static function getFacadeAccessor()
    {
        return \LaraIO\Core\Support\Theme\ThemeManager::class;
    }
}
