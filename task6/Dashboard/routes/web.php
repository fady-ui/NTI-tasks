<?php

use App\Http\Controllers\dashboard\DashboardController;
use App\Http\Controllers\dashboard\ProductControllers;
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

// Route::get('/', function () {
//     return view('welcome');
// });



Route::group(['prefix' => 'dashboard', 'as' => 'dashboard'], function () {

    Route::get('/', DashboardController::class);

    Route::prefix('products')->controller(ProductControllers::class)->name('.products.')->group(function () {
        Route::get('/index','index')->name('index');
        Route::get('/create','create')->name('create');
        Route::get('/{id}/edit','edit')->name('edit');
        Route::post('/store','store')->name('store');
        Route::put('/update/{id}','update')->name('update');
        Route::delete('/distroy/{id}','distroy')->name('distroy');
        Route::patch('/toggle/status/{id}','toggleStatus')->name('toggle.status');
    });
});
