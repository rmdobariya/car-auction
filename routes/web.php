<?php

use App\Http\Controllers\Web\HomeController;
use App\Http\Controllers\Web\LoginController;
use App\Http\Controllers\Web\PageController;
use App\Http\Controllers\Web\ResetPasswordController;
use App\Http\Controllers\Web\SocialLoginController;
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
Route::get('reset-password/{token}', [ResetPasswordController::class, 'index'])->name('reset-password');
Route::post('resetPassword', [ResetPasswordController::class, 'resetPassword'])->name('resetPassword');
//Route::get('/', function () {
//    return view('welcome');
//});
Route::get('/', [HomeController::class, 'index'])->name('/');
Route::post('/login', [LoginController::class, 'loginCheck'])->name('/login');
Route::post('/register', [LoginController::class, 'register'])->name('/register');
Route::get('/logout', [LoginController::class, 'logout'])->name('/logout');
Route::get('vehicle-details/{id}', [HomeController::class, 'vehicleDetail'])->name('vehicle-details');
//Route::get('socialAccount', [SocialLoginController::class,'socialAccount'])->name('socialAccount');
Route::get('googleCallback', [SocialLoginCOntroller::class,'googleCallback'])->name('googleCallback');
Route::get('facebookCallback', [SocialLoginController::class,'facebookCallback'])->name('facebookCallback');
Route::get('socialLogin/{type}', [SocialLoginController::class,'socialLogin'])->name('socialLogin');
Route::get('page/{slug}', [PageController::class,'index'])->name('page');
Route::get('contact-us', [PageController::class,'contactUs'])->name('contact-us');
Route::get('auction', [PageController::class,'auction'])->name('auction');
