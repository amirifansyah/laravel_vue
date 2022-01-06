<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Api\ProductController;
use App\Http\Controllers\AuthController;// manggil controller sesuai bawaan laravel 8

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

// Route::middleware('api')->group(function () {
// });

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('login', 'AuthController@login');
Route::group(['middleware' => 'auth:sanctum'], function() {
    Route::resource('products', ProductController::class);
    Route::group(['prefix' => 'auth'], function() {
        Route::any('logout', [AuthController::class, 'logout']);
        Route::post('logoutall', 'AuthController@logoutall');
    });
});
