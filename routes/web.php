<?php

use Illuminate\Support\Facades\Route;
use LaraPlatform\Core\Facades\Core;
use LaraPlatform\Core\Supports\BaseScan;

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
    Route::post('/livewire/component/{slug}', [LaraPlatform\Core\Http\Controllers\LaraServiceController::class, 'loadComponent']);
});

Route::group(['prefix' => Core::adminPrefix(), 'middleware' => ['web']], function () {
    Route::get('/', LaraPlatform\Core\Http\Livewire\Page\Dashboard\Index::class)->name('core.dashboard');
    Route::get('/table/{module}',LaraPlatform\Core\Http\Livewire\Table\Index::class)->name('core.table.slug');
});
Route::get('/test',function(){
    BaseScan::AllFile(__DIR__.'/../config/tables/',function($file){
        print_r(BaseScan::FileReturn($file->getRealPath()));
    });
});