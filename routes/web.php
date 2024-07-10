<?php

use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\CountryController;
use App\Http\Controllers\EpisodeController;
use App\Http\Controllers\GenreController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\IndexController;
use App\Http\Controllers\MovieController;
use App\Http\Controllers\UserController;
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
Route::get('/test',function(){
    return view('test'); 
});
Auth::routes();
// ---------------------------------Admin routes---------------------------------------
Route::middleware(['check.login'])->group(function () {
    // Các route hoặc controller yêu cầu đăng nhập sẽ được đặt ở đây
    Route::get('/home', [HomeController::class, 'index'])->name('home');
    Route::resource('/category', CategoryController::class);
    Route::post('resorting', [CategoryController::class,'resorting'])->name('resorting');
    
    
    Route::resource('/genre', GenreController::class);
    Route::resource('/country', CountryController::class);
    Route::resource('/movie', MovieController::class);
    Route::get('/createFormAPI', [MovieController::class, 'createFormAPI'])->name('movie.createFormAPI');
    Route::get('/createDetailsAPI', [MovieController::class, 'createDetailsAPI'])->name('movie.createDetailsAPI');
    
    Route::resource('/episode', EpisodeController::class);
    Route::get('select-movie', [EpisodeController::class, 'select_movie'])->name('select-movie');

});

// ---------------------------------Client routes--------------------------------------
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

// ---------------------------------User routes----------------------------------
Route::get('/thong-tin-nguoi-dung',[UserController::class, 'user_info'])->name('user_info');
Route::post('/cap-nhat-thong-tin',[UserController::class, 'update'])->name('update_info_user');
Route::get('/dang-nhap',[UserController::class, 'login_page'])->name('login_page');
Route::post('/login_client',[UserController::class, 'login_client'])->name('login_client');
Route::get('/dang-ky',[UserController::class, 'register'])->name('register');
Route::get('/dang-xuat',[UserController::class, 'logout'])->name('logout');
Route::post('/them-tai-khoan',[UserController::class, 'create_social_account'])->name('create_social_account');
Route::get('/social_register',[UserController::class, 'social_register'])->name('social_register');
Route::get('/kiem-tra-email',[UserController::class, 'check_email'])->name('check_email');
Route::get('/tu-phim',[UserController::class, 'follow_page'])->name('follow_page');
Route::get('/follow',[UserController::class, 'follow'])->name('follow');
Route::get('/unfollow',[UserController::class, 'unfollow'])->name('unfollow');
// Social media authentication routes 
Route::post('/xac-thuc-email',[UserController::class, 'email_verification'])->name('email_verification');
Route::get('/email_verification/{email}/{token}',[UserController::class, 'callback_email_verification'])->name('callback_email_verification');
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
Route::get('auth/github/callback',[UserController::class, 'github_callback'])->name('github_callback');
Route::get('auth/google/callback',[UserController::class, 'google_callback'])->name('google_callback');




