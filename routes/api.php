<?php

use App\Http\Controllers;
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

Route::post('/auth/register', [Controllers\AuthController::class, 'createUser']);
Route::post('/auth/login', [Controllers\AuthController::class, 'loginUser']);


Route::group([

    'middleware' => 'auth:sanctum',
    'prefix' => 'auth'

], function ($router) {

    Route::post('me', [Controllers\AuthController::class, 'me']);

    Route::post('addproduct', [Controllers\ProductsController::class, 'addProduct']);
    Route::get('products', [Controllers\ProductsController::class, 'getProducts']);
    Route::put('products/{id}', [Controllers\ProductsController::class, 'updateProduct']);
    Route::post('deleteproduct', [Controllers\ProductsController::class, 'deleteProduct']);

});

