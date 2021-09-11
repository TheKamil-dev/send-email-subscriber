<?php

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
Route::group([
    'prefix' => 'post'
], function () {
    Route::post('create', [App\Http\Controllers\PostController::class, 'createPost']);

});

Route::group([
    'prefix' => 'subscribe'
], function () {
    Route::post('create', [App\Http\Controllers\SubscriberController::class, 'createSubscription']);

});

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
