<?php

namespace GateGem\Core\Facades;

use Illuminate\Support\Facades\Facade;

/**
 * 
 * @method static \GateGem\Core\Builder\Menu\MenuBuilder addMenuItem($text, $icon = '', $permission = '', $actionValue = '', $actionType = MenuBuilder::ItemLink, $class = '', $id = '', $sort = 500, $postion = 'sidebar')
 * @method static \GateGem\Core\Builder\Menu\MenuBuilder addMenuSub($callback, $text, $icon = '', $permission = '', $actionValue = '', $actionType = MenuBuilder::ItemLink, $class = '', $id = '', $sort = 500, $postion = 'sidebar')
 * @method static void doRender($postion)
 * @method static string getHtml($postion)
 *
 * @see \GateGem\Core\Facades\Menu
 */
class Menu extends Facade
{
    protected static function getFacadeAccessor()
    {
        return \GateGem\Core\Support\Core\MenuManager::class;
    }
}
