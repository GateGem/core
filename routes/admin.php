<?php

use Illuminate\Support\Facades\Route;
use GateGem\Core\Facades\Theme;
use Illuminate\Support\Facades\Artisan;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

add_filter('filter_theme_layout', function () {
    $theme = get_option('page_admin_theme', 'gate-admin');
    if (Theme::has($theme))
        return $theme;
    return 'gate-admin';
});
Route::get('/inilink', function () {
    Artisan::call('storage:link');
    Artisan::call('module:link');
});
Route::get('/',  apply_filters('route_page_dashboard_component', GateGem\Core\Http\Livewire\Page\Dashboard\Index::class))->name('core.dashboard');
Route::get('/table/{module}', GateGem\Core\Http\Livewire\Table\Index::class)->name('core.table.slug');
Route::get('/option', GateGem\Core\Http\Livewire\Page\Option\Index::class)->name('core.option');
Route::get('/filemanager', GateGem\Core\Http\Livewire\Common\Filemanager\Index::class)->name('core.filemanager');

do_action('register_route_admin');
