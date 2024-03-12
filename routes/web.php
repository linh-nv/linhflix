<?php

use App\Http\Controllers\IndexController;
use Illuminate\Support\Facades\Route;
use Laravel\Socialite\Facades\Socialite;
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
Route::get('/dang-ky',[IndexController::class, 'register'])->name('register');
Route::get('/dang-xuat',[IndexController::class, 'logout'])->name('logout');
Route::post('/login',[IndexController::class, 'login'])->name('login');
Route::get('/dang-nhap',[IndexController::class, 'login_page'])->name('login_page');
Route::post('/them-tai-khoan',[IndexController::class, 'create_social_account'])->name('create_social_account');
Route::get('/social_register',[IndexController::class, 'social_register'])->name('social_register');
Route::post('/xac-thuc-email',[IndexController::class, 'email_verification'])->name('email_verification');
Route::get('/kiem-tra-email',[IndexController::class, 'check_email'])->name('check_email');
Route::get('/email_verification/{email}/{token}',[IndexController::class, 'callback_email_verification'])->name('callback_email_verification');

Route::get('/chinh-sach',function(){
    return '<h1>chinh sach</h1>';
});
Route::get('auth/facebook', function(){
    return Socialite::driver('facebook')->redirect();
});
Route::get('auth/facebook/callback', function(){
    $user = Socialite::driver('facebook')->user();
    return $user;
});

Route::get('/auth/github', function () {
    return Socialite::driver('github')->redirect();
});
Route::get('/auth/google', function () {
    return Socialite::driver('google')->redirect();
});
Route::get('auth/github/callback',[IndexController::class, 'github_callback'])->name('github_callback');
Route::get('auth/google/callback',[IndexController::class, 'google_callback'])->name('google_callback');


