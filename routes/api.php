<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\CategoryController;

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

Route::middleware('auth:api')->group(function() {

    Route::get('/user', function (Request $request) {
        return $request->user();
    });
});

// Route::get('/user', fn(Request $request) => $request->user());
Route::get('/categories', [CategoryController::class, 'index']);
Route::get('/categories/{category:slug}', [CategoryController::class, 'getProducts']);
Route::get('/products/{product:slug}', [CategoryController::class, 'getproduct']);
Route::post('/check-quantity/{productId}', [CategoryController::class, 'checkQuantity']);



