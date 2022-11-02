<?php
add_link_symbolic(__DIR__ . '/public', public_path('themes/lara-admin'));

add_asset_js(asset('themes/lara-admin/js/lara-admin.js'), '',  10);
add_asset_css(asset('themes/lara-admin/css/lara-admin.css'), '', 10);
add_page_body_class('lara-admin');

// add_filter('module_action_left',function($valuePrev){
//     return $valuePrev.'<button class="btn btn-sm  btn-primary" wire:component="core::table.index({\'module\':\'permission\'})"> <i class="bi bi-magic"></i> <span> Quản lý quyền1 </span></button>';
// });
// add_filter('module_role_action_left',function($valuePrev){
//     return $valuePrev.'<button class="btn btn-sm  btn-primary" wire:component="core::table.index({\'module\':\'permission\'})"> <i class="bi bi-magic"></i> <span> Quản lý quyền2 </span></button>';
// });
// add_filter('module_role_action_left',function($valuePrev){
//     return $valuePrev.'<button class="btn btn-sm  btn-primary" wire:component="core::table.index({\'module\':\'permission\'})"> <i class="bi bi-magic"></i> <span> Quản lý quyền3 </span></button>';
// });