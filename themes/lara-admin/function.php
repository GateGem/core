<?php
add_link_symbolic(__DIR__ . '/public', public_path('themes/lara-admin'));

add_asset_js(asset('themes/lara-admin/js/lara-admin.js'), '',  10);
add_asset_css(asset('themes/lara-admin/css/lara-admin.css'), '', 10);
add_page_body_class('lara-admin');
