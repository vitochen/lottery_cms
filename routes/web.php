<?php

use App\Http\Controllers\EventController;
use App\Http\Controllers\EventMemberController;
use App\Http\Controllers\EventPriceController;
use App\Http\Controllers\IndexController;
use App\Http\Controllers\MemberController;
use App\Http\Controllers\PriceController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Storage;

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
    Route::get('/', 'index')->name('home');
});

Route::controller(EventController::class)
        ->name('event.')
        ->prefix('event')
        ->group(function () {
            Route::get('/', 'index')->name('index');
            Route::get('/data', 'data')->name('data');
            Route::get('/create', 'create')->name('create');
            Route::post('/create', 'store');
            Route::get('/{id}/edit', 'edit')->name('edit');
            Route::put('/{id}/edit', 'update');
            Route::post('/create', 'store');
            Route::get('/{id}/delete', 'delete')->name('delete');
            Route::delete('/{id}/delete', 'destroy');

            Route::get('/{id}/histroy', 'showPrice')->name('showPrice');
            Route::get('/{id}/pool', 'showPool')->name('showPool');
            Route::get('/{id}/lottery_count', 'lotteryCount')->name('lotteryCount');
        });

Route::controller(EventPriceController::class)
        ->name('event.price.')
        ->prefix('event')
        ->group(function () {
            Route::get('/{id}/price/create', 'create')->name('create');
            Route::post('/{id}/price/create', 'store');

            Route::get('/price/create_element', 'createElement')->name('create.component');
        });

Route::controller(EventMemberController::class)
        ->name('event.member.')
        ->prefix('event')
        ->group(function () {
            Route::get('/{id}/member/create', 'create')->name('create');
            Route::post('/{id}/member/import', 'import')->name('import');
        });

Route::controller(MemberController::class)
        ->name('member.')
        ->prefix('member')
        ->group(function () {
            Route::get('/', 'index')->name('index');
            Route::get('/data', 'data')->name('data');
        });

Route::controller(PriceController::class)
        ->name('price.')
        ->prefix('price')
        ->group(function () {
            Route::get('/{id}/draw', 'reveal')->name('reveal');
            Route::get('/{id}/winner', 'winner')->name('winner');
        });

Route::get('pool_samplefile', function() {
    return Storage::download('public/pool_import_sample.xlsx');
})->name('download.pool_import_sample');

