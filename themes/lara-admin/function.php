<?php

use LaraPlatform\Core\Builder\Menu\MenuBuilder;

add_asset_js(asset('themes/lara-admin/js/lara-admin.js'), 0);
add_asset_css(asset('themes/lara-admin/css/lara-admin.css'), 0);
add_page_body_class('lara-admin');
add_menu_with_sub('Dasboard', function ($subItem) {
    $subItem->addItem(function ($item) {
        $item->setItem('Dasboard1', 'bi bi-speedometer', '', '');
        $item->addItem(function ($subItem2) {
            $subItem2->setItem('Dasboard1', 'bi bi-speedometer', '', '');
            $subItem2->addItem(function ($subItem3) {
                $subItem3->setItem('Dasboard1', 'bi bi-speedometer', '', 'abc');
            });
        });
    })->addItem(function ($item) {
        $item->setItem('Dasboard2', 'bi bi-speedometer', '', 'core::demo', MenuBuilder::ItemComponent);
    });
}, 'bi bi-speedometer');
