<?php

use GateGem\Core\Facades\Theme;
use PhpParser\Node\Expr\FuncCall;

if (!function_exists('add_asset_js')) {
    function add_asset_js($path, $cdnPath = '', $priority = 100, $local = 'asset_body_after')
    {
        Theme::getAssets()->AddScript($local, $path, $cdnPath, $priority, true);
    }
}
if (!function_exists('add_asset_css')) {
    function add_asset_css($path, $cdnPath = '', $priority = 100, $local = 'asset_head_after')
    {
        Theme::getAssets()->AddStyle($local, $path, $cdnPath, $priority, true);
    }
}

if (!function_exists('add_asset_script')) {
    function add_asset_script($script, $priority = 100, $local = 'asset_body_after')
    {
        Theme::getAssets()->AddScript($local, $script, '', $priority);
    }
}
if (!function_exists('add_asset_style')) {
    function add_asset_style($style, $priority = 100, $local = 'asset_head_after')
    {
        Theme::getAssets()->AddStyle($local, $style, '', $priority);
    }
}

if (!function_exists('page_title')) {
    function page_title()
    {
        return apply_filters('page_title', Theme::getAssets()->getData('page_title'));
    }
}

if (!function_exists('page_description')) {
    function page_description()
    {
        return apply_filters('page_description', Theme::getAssets()->getData('page_description'));
    }
}
if (!function_exists('page_body_class')) {
    function page_body_class()
    {
        return apply_filters('page_body_class', trim(Theme::getAssets()->getData('page_body_class')));
    }
}
if (!function_exists('add_page_body_class')) {
    function add_page_body_class($class)
    {
        return Theme::getAssets()->setData('page_body_class', Theme::getAssets()->getData('page_body_class') . ' ' . $class);
    }
}
if (!function_exists('page_lang')) {
    function page_lang()
    {
        return Theme::getAssets()->getData('page_lang', 'en');
    }
}

if (!function_exists('get_layout_theme')) {
    function get_layout_theme()
    {
        return Theme::Layout();
    }
}
if (!function_exists('get_format_bytes')) {
    function get_format_bytes(int $size)
    {
        $base = log($size, 1024);
        $suffixes = array('', 'KB', 'MB', 'GB', 'TB');
        return round(pow(1024, $base - floor($base)), 2) . '' . $suffixes[floor($base)];
    }
}
if (!function_exists('get_file_info')) {
    function get_file_info($path)
    {
        $rs = array();
        $pathinfo = pathinfo($path);
        $stat = stat($path);
        $rs['realpath'] = realpath($path);
        $rs['dirname'] = $pathinfo['dirname'];
        $rs['basename'] = $pathinfo['basename'];
        $rs['filename'] = $pathinfo['filename'];
        $rs['extension'] = $pathinfo['extension'];
        $rs['mime'] = finfo_file(finfo_open(FILEINFO_MIME_TYPE), $path);
        $rs['encoding'] = finfo_file(finfo_open(FILEINFO_MIME_ENCODING), $path);
        $rs['size'] = $stat[7];
        $rs['size_string'] = get_format_bytes($stat[7]);
        $rs['atime'] = $stat[8];
        $rs['mtime'] = $stat[9];
        $rs['permission'] = substr(sprintf('%o', fileperms($path)), -4);
        $rs['fileowner'] = getenv('USERNAME');
        return $rs;
    }
}
