<?php

use LaraPlatform\Core\Builder\Menu\MenuBuilder;
use LaraPlatform\Core\Facades\Menu;


if (!function_exists('add_menu_item')) {
    function add_menu_item($text, $icon = '', $permission = '', $actionValue = '', $actionType = MenuBuilder::ItemLink, $class = '', $id = '', $postion = 'sidebar')
    {
        return Menu::addMenuItem($text, $icon, $permission, $actionValue, $actionType, $class, $id, $postion);
    }
}
if (!function_exists('add_menu_with_sub')) {
    function add_menu_with_sub($text, $callback, $icon, $class = '', $id = '', $postion = 'sidebar')
    {
        return Menu::addMenuSub($text, $callback, $icon, $class, $id, $postion);
    }
}
if (!function_exists('do_menu_render')) {
    function do_menu_render($postion = 'sidebar')
    {
        Menu::doRender($postion);
    }
}
if (!function_exists('get_html_menu')) {
    function get_html_menu($postion = 'sidebar')
    {
        return Menu::getHtml($postion);
    }
}
