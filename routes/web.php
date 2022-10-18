<?php

use Illuminate\Support\Facades\Route;
use LaraPlatform\Core\Facades\Core;
use LaraPlatform\Core\Http\Controllers\LaraServiceController;
use LaraPlatform\Core\Http\Livewire\Dashboard;

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
    Route::post('/livewire/component/{slug}', [LaraServiceController::class, 'loadComponent']);
});

Route::group(['prefix' => Core::adminPrefix(), 'middleware' => ['web']], function () {
    Route::get('/', Dashboard::class);
    Route::get('/test2', function () {
        return view('core::demo2');
    });
});
