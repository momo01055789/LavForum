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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::apiResource('question',App\Http\Controllers\QuestionController::class);
Route::apiResource('category',App\Http\Controllers\CategoryController::class);
Route::apiResource('question/{question}/reply',App\Http\Controllers\ReplyController::class);
Route::post('{reply}/like',[App\Http\Controllers\LikeController::class,'likeit']);
Route::delete('{reply}/unlike',[App\Http\Controllers\LikeController::class,'unlikeit']);
Route::post('notifications',[App\Http\Controllers\NotificationsController::class,'Notify']);
Route::post('markAsRead',[App\Http\Controllers\NotificationsController::class,'Read']);

Route::group(['prefix' => 'auth'], function () {

    Route::post('signup', [App\Http\Controllers\AuthController::class,'signup']);
    Route::post('login', [App\Http\Controllers\AuthController::class,'login']);
    Route::post('logout', [App\Http\Controllers\AuthController::class,'logout']);
    Route::post('refresh', [App\Http\Controllers\AuthController::class,'refresh']);
    Route::post('me', [App\Http\Controllers\AuthController::class,'me']);

});