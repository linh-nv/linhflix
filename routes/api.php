<?php

use App\Http\Controllers\Api\CategoryAPI;
use App\Http\Controllers\Api\CountryAPI;
use App\Http\Controllers\Api\EpisodeAPI;
use App\Http\Controllers\Api\GenreAPI;
use App\Http\Controllers\Api\MovieAPI;
use App\Http\Controllers\Api\UserAPI;
use App\Http\Controllers\api\ViewAPI;
use App\Models\Country;
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

// View
Route::group(['prefix' => 'view', 'middleware' => 'check_request_valid:Views'], function () {
    Route::any('/', [ViewAPI::class, 'index'])->middleware('handle_method_requests:GET');
    // Tìm kiếm
    Route::post('/', [ViewAPI::class, 'store']);
    // Tạo mới và kiểm tra có nhập thiếu trường nào không
    $rules = [
        'movie_id' => 'integer',
        'view_number' => 'integer',
        'view_date' => 'date_format:Y-m-d'
    ];
    Route::any('/create', [ViewAPI::class, 'create'])
    ->middleware('handle_method_requests:POST')
    ->middleware('check_required_fields:movie_id,view_number')
    ->middleware('check_data_type:'. json_encode($rules));

    Route::any('/{id}', [ViewAPI::class, 'show']);

    Route::put('/{id}', [ViewAPI::class, 'update'])
    ->middleware('check_data_type:'. json_encode($rules));

    Route::delete('/{id}', [ViewAPI::class, 'destroy']);
});

// Movie
Route::group(['prefix' => 'movie', 'middleware' => 'check_request_valid:Movies'], function () {
    Route::any('/',[MovieAPI::class, 'index'])->middleware('handle_method_requests:GET');
    // tìm kiếm
    Route::post('/',[MovieAPI::class, 'store']);

    // tạo mới và kiểm tra có nhập thiếu trường nào không
    $rules = [
        'year' => 'integer',
        'category_id' => 'integer',
        'genre_id' => 'integer',
        'country_id' => 'integer',
        'view' => 'integer',
    ];
    Route::any('/create', [MovieAPI::class, 'create'])
    ->middleware('handle_method_requests:POST')
    ->middleware('check_required_fields:slug, title, name_eng, year, image, poster')
    ->middleware('check_data_type:'. json_encode($rules));

    Route::any('/{id}',[MovieAPI::class, 'show']);

    Route::put('/{id}',[MovieAPI::class, 'update'])
    ->middleware('check_data_type:'. json_encode($rules));

    Route::delete('/{id}',[MovieAPI::class, 'destroy']);
});

// Category
Route::group(['prefix' => 'category', 'middleware' => 'check_request_valid:Categories'], function () {
    Route::any('/',[CategoryAPI::class, 'index'])->middleware('handle_method_requests:GET');
    // tìm kiếm
    Route::post('/',[CategoryAPI::class, 'store']);

    // tạo mới và kiểm tra có nhập thiếu trường nào không
    $rules = [
        'status' => 'integer',
        'position' => 'integer',
    ];
    Route::any('/create', [CategoryAPI::class, 'create'])
    ->middleware('handle_method_requests:POST')
    ->middleware('check_required_fields:slug, title, description, status, position')
    ->middleware('check_data_type:'. json_encode($rules));

    Route::any('/{id}',[CategoryAPI::class, 'show']);

    Route::put('/{id}',[CategoryAPI::class, 'update'])
    ->middleware('check_data_type:'. json_encode($rules));

    Route::delete('/{id}',[CategoryAPI::class, 'destroy']);
});

// Genre
Route::group(['prefix' => 'genre', 'middleware' => 'check_request_valid:Genres'], function () {
    Route::any('/',[GenreAPI::class, 'index'])->middleware('handle_method_requests:GET');
    // tìm kiếm
    Route::post('/',[GenreAPI::class, 'store']);

    // tạo mới và kiểm tra có nhập thiếu trường nào không
    $rules = [
        'status' => 'integer',
    ];
    Route::any('/create', [GenreAPI::class, 'create'])
    ->middleware('handle_method_requests:POST')
    ->middleware('check_required_fields:slug, title, description, status')
    ->middleware('check_data_type:'. json_encode($rules));

    Route::any('/{id}',[GenreAPI::class, 'show']);

    Route::put('/{id}',[GenreAPI::class, 'update'])
    ->middleware('check_data_type:'. json_encode($rules));

    Route::delete('/{id}',[GenreAPI::class, 'destroy']);
});

// Country
Route::group(['prefix' => 'country', 'middleware' => 'check_request_valid:Countries'], function () {
    Route::any('/',[CountryAPI::class, 'index'])->middleware('handle_method_requests:GET');
    // tìm kiếm
    Route::post('/',[CountryAPI::class, 'store']);

    // tạo mới và kiểm tra có nhập thiếu trường nào không
    $rules = [
        'status' => 'integer',
    ];
    Route::any('/create', [CountryAPI::class, 'create'])
    ->middleware('handle_method_requests:POST')
    ->middleware('check_required_fields:slug, title, description, status')
    ->middleware('check_data_type:'. json_encode($rules));

    Route::any('/{id}',[CountryAPI::class, 'show']);

    Route::put('/{id}',[CountryAPI::class, 'update'])
    ->middleware('check_data_type:'. json_encode($rules));

    Route::delete('/{id}',[CountryAPI::class, 'destroy']);
});

// Episode
Route::group(['prefix' => 'episode', 'middleware' => 'check_request_valid:Episodes'], function () {
    Route::any('/', [EpisodeAPI::class, 'index'])->middleware('handle_method_requests:GET');
    // Tìm kiếm
    Route::post('/', [EpisodeAPI::class, 'store']);
    // Tạo mới và kiểm tra có nhập thiếu trường nào không
    $rules = [
        'movie_id' => 'integer',
        'episode' => 'integer',
    ];
    Route::any('/create', [EpisodeAPI::class, 'create'])
    ->middleware('handle_method_requests:POST')
    ->middleware('check_required_fields:movie_id, linkphim, episode')
    ->middleware('check_data_type:'. json_encode($rules));

    Route::any('/{id}', [EpisodeAPI::class, 'show']);

    Route::put('/{id}', [EpisodeAPI::class, 'update'])
    ->middleware('check_data_type:'. json_encode($rules));

    Route::delete('/{id}', [EpisodeAPI::class, 'destroy']);
});
// Route::apiResource('user', UserAPI::class);
