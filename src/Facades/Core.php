<?php

namespace GateGem\Core\Facades;

use Illuminate\Support\Facades\Facade;

/**
 * 
 * @method static void callAfterResolving(string $name,callable $callback)
 * @method static void loadViewsFrom(string $path,string $namespace)
 * @method static string RoleAdmin()
 * @method static string adminPrefix()
 * @method static void MapPermissionModule(array $arr)
 * @method static void SwitchLanguage(string $lang, bool $redirect_current)
 * @method static string checkCurrentLanguage()
 * @method static string RootPath(string $path)
 * @method static string ThemePath(string $path)
 * @method static string PluginPath(string $path)
 * @method static string ModulePath(string $path)
 * @method static string PathBy(string $path)
 * @method static bool LoadHelper(string $path)
 * @method static void RegisterAllFile(string $path)
 * @method static void minifyOptimizeHtml(string $buffer)
 * @method static mixed By(string $name)
 * @method static string checkFolder()
 * @method static bool FileExists(string $path)
 * @method static bool SaveFileJson(string $path,string $content)
 * @method static string FileJson(string $path)
 * @method static string FileReturn(string $path)
 * @method static mixed AllFile(string $path,callable $callback = null,callable $filter = null)
 * @method static mixed AllClassFile(string $path,string $namespace,callable $callback = null,callable $filter = null)
 * @method static mixed AllFolder(string $path,callable $callback = null,callable $filter = null)
 * @method static mixed Link(string $target,string $link,bool $relative = false,bool $force = true)
 * 
 * @see \GateGem\Core\Facades\Core
 */
class Core extends Facade
{
    protected static function getFacadeAccessor()
    {
        return \GateGem\Core\Support\Core\CoreManager::class;
    }
}
