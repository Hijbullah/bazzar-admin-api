<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\AuthController;
use App\Http\Controllers\API\OrderController;
use App\Http\Controllers\API\AddressController;
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

// Route::middleware('auth:api')->group(function() {

//     Route::get('/user', function (Request $request) {
//         return $request->user();
//     });
// });

// Route::get('/user', fn(Request $request) => $request->user());
Route::get('/categories', [CategoryController::class, 'index']);
Route::get('/categories/{category:slug}', [CategoryController::class, 'getProducts']);
Route::get('/products/{product:slug}', [CategoryController::class, 'getproduct']);
Route::post('/check-quantity/{productId}', [CategoryController::class, 'checkQuantity']);

// address 
Route::get('/addresses/{user}', [AddressController::class, 'index']);
Route::post('/addresses/{user}/create', [AddressController::class, 'create']);

Route::get('/orders/{order}', [OrderController::class, 'getOrder']);
Route::post('/place-order', [OrderController::class, 'placeOrder']);
Route::post('/make-payment', [OrderController::class, 'makePayment']);


Route::prefix('auth')->middleware('api')->group(function() {
    Route::post('login', [AuthController::class,'login']);
    Route::post('logout', [AuthController::class,'logout']);
    Route::post('refresh', [AuthController::class,'refresh']);
    Route::get('user', [AuthController::class,'user']);
});




