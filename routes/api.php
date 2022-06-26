<?php

use App\Http\Controllers\Api\V1\CategoryApiController;
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

Route::group(['prefix' => 'v1', 'as' => 'api.', 'namespace' => 'Api\V1'], function () {
    // Categories
    Route::get('categories', [CategoryApiController::class, 'index'])->name('categories.index');
    Route::get('categories/{id}', [CategoryApiController::class, 'get']);
    Route::get('categories/{category}', [CategoryApiController::class, 'show'])->name('categories.show');
    Route::post('categories', [CategoryApiController::class, 'create']);
    Route::post('categories/{id}', [CategoryApiController::class, 'update']);
    Route::delete('categories/{id}', [CategoryApiController::class, 'delete']);
});

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
