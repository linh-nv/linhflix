<?php

use App\Http\Controllers\Api\CategoryAPI;
use App\Http\Controllers\Api\GenreAPI;
use App\Http\Controllers\Api\MovieAPI;
use App\Http\Controllers\Api\UserAPI;
use App\Http\Controllers\api\ViewAPI;
use App\Http\Middleware\Handle_Get_Requests;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

// Movie
Route::group(['prefix' => 'view'], function () {
    Route::any('/',[ViewAPI::class, 'index'])->middleware(Handle_Get_Requests::class);
    Route::post('/',[ViewAPI::class, 'store']);

    Route::any('/{id}',[ViewAPI::class, 'show'])->middleware(Handle_Get_Requests::class);
    Route::put('/{id}',[ViewAPI::class, 'update']);
    Route::delete('/{id}',[ViewAPI::class, 'destroy']);
});

// Movie
Route::group(['prefix' => 'movie'], function () {
    Route::any('/',[MovieAPI::class, 'index'])->middleware(Handle_Get_Requests::class);
    Route::post('/',[MovieAPI::class, 'store']);
    Route::post('/create',[MovieAPI::class, 'create']);

    Route::any('/{id}',[MovieAPI::class, 'show']);
    Route::put('/{id}',[MovieAPI::class, 'update']);
    Route::delete('/{id}',[MovieAPI::class, 'destroy']);
});

Route::apiResource('category', CategoryAPI::class);
Route::apiResource('genre', GenreAPI::class);
Route::apiResource('user', UserAPI::class);
