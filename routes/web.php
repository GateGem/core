<?php

use Illuminate\Support\Facades\Route;
use GateGem\Core\Facades\Core;
use GateGem\Core\Facades\Theme;
use GateGem\Core\Http\Middleware\Authenticate;
use GateGem\Core\Http\Middleware\HtmlMinifier;

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

Route::group(['prefix' => 'lara', 'middleware' => ['web']], function () {
    Route::post('/livewire/component/{slug}', [GateGem\Core\Http\Controllers\LaraServiceController::class, 'loadComponent']);
    Route::post('/switchSidebar', [GateGem\Core\Http\Controllers\LaraServiceController::class, 'switchSidebar']);
});

Route::group(['prefix' => Core::adminPrefix(), 'middleware' => ['web', Authenticate::class]], function () {
    add_filter('filter_theme_layout', function () {
        $theme = get_option('page_admin_theme', 'gate-admin');
        if (Theme::has($theme))
            return $theme;
        return 'gate-admin';
    });
    Route::get('/',  apply_filters('route_page_dashboard_component', GateGem\Core\Http\Livewire\Page\Dashboard\Index::class))->name('core.dashboard');
    Route::get('/table/{module}', GateGem\Core\Http\Livewire\Table\Index::class)->name('core.table.slug');
    Route::get('/option', GateGem\Core\Http\Livewire\Page\Option\Index::class)->name('core.option');
    Route::get('/filemanager', GateGem\Core\Http\Livewire\Common\Filemanager\Index::class)->name('core.filemanager');

    do_action('register_route_admin');
});
Route::group(['middleware' => ['web']], function () {
    Route::get(apply_filters('route_page_login_url', 'auth/login'), apply_filters('route_page_login_component', GateGem\Core\Http\Livewire\Page\Auth\Login::class))->name('core.login');

    Route::get(apply_filters('route_page_register_url', 'auth/register'), apply_filters('route_page_register_component', GateGem\Core\Http\Livewire\Page\Auth\Register::class))->name('core.register');
    Route::get(apply_filters('route_page_forgot_password_url', 'auth/forgot-password'), apply_filters('route_page_forgot_password_component', GateGem\Core\Http\Livewire\Page\Auth\ForgotPssword::class))->name('core.forgot_password');
});
