<?php

use LaraPlatform\Core\Builder\Menu\MenuBuilder;

add_asset_js(asset('themes/lara-admin/js/lara-admin.js'), 0);
add_asset_css(asset('themes/lara-admin/css/lara-admin.css'), 0);
add_page_body_class('lara-admin');
add_menu_with_sub('Dasboard', function ($subItem) {
    $subItem->addItem(function ($item) {
        $item->setItem('Dasboard', 'bi bi-speedometer', '', 'core.dashboard', MenuBuilder::ItemRouter);
    });
}, 'bi bi-speedometer');

add_menu_with_sub('User', function ($subItem) {
    $subItem->addItem(function ($item) {
        $item->setItem('User', 'bi bi-speedometer', '', 'link');
    })->addItem(function ($item) {
        $item->setItem('Dasboard2', 'bi bi-speedometer', '', 'core::table.edit', MenuBuilder::ItemComponent);
    });
}, 'bi bi-speedometer');
add_menu_with_sub('Setting', function ($subItem) {
    $subItem->addItem(function ($item) {
        $item->setItem('Dasboard1', 'bi bi-speedometer', '', 'link');
    })->addItem(function ($item) {
        $item->setItem('Dasboard2', 'bi bi-speedometer', '', 'core::demo', MenuBuilder::ItemComponent);
    });
}, 'bi bi-speedometer');
