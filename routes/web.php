<?php

use App\Http\Controllers\IndexController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/


Route::get('/',[IndexController::class, 'home'])->name('home');
Route::get('/phim/{slug}',[IndexController::class, 'movie'])->name('movie');
Route::get('/xem-phim/{slug}',[IndexController::class, 'watch'])->name('watch');
Route::get('/xem-phim/{slug}/tap-{episode}', [IndexController::class, 'watchEpisode'])->name('watch.episode');

Route::get('/danh-muc/{slug}',[IndexController::class, 'category'])->name('category');
Route::get('/the-loai/{slug}',[IndexController::class, 'genre'])->name('genre');
Route::get('/quoc-gia/{slug}',[IndexController::class, 'country'])->name('country');
Route::get('/tim-kiem',[IndexController::class, 'search'])->name('search');
Route::get('/dao-dien',[IndexController::class, 'director'])->name('director');
Route::get('/dien-vien',[IndexController::class, 'actor'])->name('actor');
Route::get('/cap-nhat-phim/{slug}',[IndexController::class, 'updateMovie'])->name('updateMovie');
Route::get('/kho-phim',[IndexController::class, 'new_movie'])->name('new_movie');
Route::get('/goi-y-phim',[IndexController::class, 'movie_suggest'])->name('movie_suggest');
Route::get('/them-phim',[IndexController::class, 'add_movie'])->name('add_movie');


