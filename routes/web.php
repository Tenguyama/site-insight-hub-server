<?php

use App\Http\Controllers\SiteController;
use App\Http\Controllers\WelcomeController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

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
Auth::routes();

Route::get('/', [WelcomeController::class, 'index'])
    ->name('welcome');

Route::group(['middleware' => 'auth:sanctum'], function () {
    Route::get('/sites', [SiteController::class, 'index'])
        ->name('sites');
    Route::get('/site/add', [SiteController::class, 'add'])
        ->name('site.add');
    Route::get('/site/{id}/show', [SiteController::class, 'show'])
        ->name('site.show')
        ->where('id', '[1-9][0-9]*');
});

