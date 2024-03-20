<?php

use App\Http\Controllers\Api\CategoryAPI;
use App\Http\Controllers\Api\GenreAPI;
use App\Http\Controllers\Api\MovieAPI;
use App\Http\Controllers\Api\UserAPI;
use App\Http\Controllers\api\ViewAPI;
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

Route::apiResource('view', ViewAPI::class);
Route::apiResource('movie', MovieAPI::class);
Route::apiResource('category', CategoryAPI::class);
Route::apiResource('genre', GenreAPI::class);
Route::apiResource('user', UserAPI::class);
