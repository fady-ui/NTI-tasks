<?php

use App\Http\Controllers\Apis\ProductsController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});


Route::get('products/', [ProductsController::class, 'index']);
Route::get('products/create', [ProductsController::class, 'create']);
Route::get('products/{id}/edit', [ProductsController::class, 'edit']);
Route::post('products/store', [ProductsController::class, 'store']);
Route::post('products/{id}/update', [ProductsController::class, 'update']);
Route::delete('products/{id}/delete', [ProductsController::class, 'delete']);
