<?php

use LaraPlatform\Core\Facades\Core;

if (!function_exists('root_path')) {
    function root_path($path = '')
    {
        return Core::RootPath($path);
    }
}
if (!function_exists('module_path')) {
    function module_path($path = '')
    {
        return Core::ModulePath($path);
    }
}
if (!function_exists('theme_path')) {
    function theme_path($path = '')
    {
        return Core::ThemePath($path);
    }
}
if (!function_exists('plugin_path')) {
    function plugin_path($path = '')
    {
        return Core::ThemePath($path);
    }
}
