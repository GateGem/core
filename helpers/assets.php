<?php

use LaraPlatform\Core\Facades\Theme;

if (!function_exists('add_asset_js')) {
    function add_asset_js($path, $cdnPath = '',$priority = 20, $local = 'asset_footer_before')
    {
        Theme::getAssets()->addScript($local, $path, $cdnPath, true);
    }
}
if (!function_exists('add_asset_css')) {
    function add_asset_css($path, $cdnPath = '', $local = 'asset_header_before',$priority = 20,)
    {
        Theme::getAssets()->addStyle($local, $path, $cdnPath, true);
    }
}

if (!function_exists('add_asset_script')) {
    function add_asset_script($script, $local = 'asset_footer_after',$priority = 20)
    {
        Theme::getAssets()->addScript($local, $script);
    }
}
if (!function_exists('add_asset_style')) {
    function add_asset_style($style, $local = 'asset_header_after',$priority = 20)
    {
        Theme::getAssets()->addStyle($local, $style);
    }
}
if (!function_exists('load_asset_local')) {
    function load_asset_local($local = 'asset_header_after')
    {
        Theme::getAssets()->loadAsset($local);
    }
}


if (!function_exists('page_title')) {
    function page_title()
    {
        return Theme::getAssets()->getData('page_title');
    }
}

if (!function_exists('page_description')) {
    function page_description()
    {
        return Theme::getAssets()->getData('page_description');
    }
}
if (!function_exists('page_body_class')) {
    function page_body_class()
    {
        return trim(Theme::getAssets()->getData('page_body_class'));
    }
}
if (!function_exists('add_page_body_class')) {
    function add_page_body_class($class)
    {
        return Theme::getAssets()->setData('page_body_class',Theme::getAssets()->getData('page_body_class').' '.$class);
    }
}
if (!function_exists('page_lang')) {
    function page_lang()
    {
        return Theme::getAssets()->getData('page_lang','en');
    }
}

if (!function_exists('get_layout_theme')) {
    function get_layout_theme()
    {
        return Theme::Layout();
    }
}
