<?php

use App\Http\Controllers\EventController;
use App\Http\Controllers\IndexController;
use App\Http\Controllers\PriceController;
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

Route::controller(IndexController::class)->group(function () {
    Route::get('/', 'index')->name('index');
});

Route::controller(EventController::class)
        ->name('event.')
        ->prefix('event')
        ->group(function () {
            Route::get('/', 'index')->name('index');
            Route::get('/data', 'data')->name('data');
            Route::get('/create', 'create')->name('create');
            Route::post('/create', 'store');
        });

Route::controller(MemberController::class)
        ->name('member.')
        ->prefix('member')
        ->group(function () {
            Route::get('/', 'index')->name('index');
            Route::get('/', 'data')->name('data');
        });

Route::controller(PriceController::class)
        ->name('member.')
        ->prefix('member')
        ->group(function () {
            Route::get('/', 'create')->name('create');
            Route::get('/', 'store');
        });