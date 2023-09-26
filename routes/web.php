<?php

use App\Http\Controllers\Web\AuctionController;
use App\Http\Controllers\Web\BidController;
use App\Http\Controllers\Web\HomeController;
use App\Http\Controllers\Web\LoginController;
use App\Http\Controllers\Web\PageController;
use App\Http\Controllers\Web\ProfileController;
use App\Http\Controllers\Web\ResetPasswordController;
use App\Http\Controllers\Web\SocialLoginController;
use App\Http\Controllers\Web\VehicleController;
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
//Route::get('reset-password/{token}', [ResetPasswordController::class, 'index'])->name('reset-password');
//Route::post('resetPassword', [ResetPasswordController::class, 'resetPassword'])->name('resetPassword');
//Route::get('/', function () {
//    return view('welcome');
//});
Route::get('/', [HomeController::class, 'index'])->name('/');
Route::post('/login', [LoginController::class, 'loginCheck'])->name('/login');
Route::post('/register', [LoginController::class, 'register'])->name('/register');
Route::get('/logout', [LoginController::class, 'logout'])->name('/logout');
Route::get('vehicle-details/{id}', [HomeController::class, 'vehicleDetail'])->name('vehicle-details');
Route::get('vehicle-bid-modal/{id}', [HomeController::class, 'vehicleBid'])->name('vehicle-bid-modal');
//Route::get('socialAccount', [SocialLoginController::class,'socialAccount'])->name('socialAccount');
Route::get('googleCallback', [SocialLoginCOntroller::class,'googleCallback'])->name('googleCallback');
Route::get('facebookCallback', [SocialLoginController::class,'facebookCallback'])->name('facebookCallback');
Route::get('socialLogin/{type}', [SocialLoginController::class,'socialLogin'])->name('socialLogin');
Route::get('page/{slug}', [PageController::class,'index'])->name('page');
Route::get('contact-us', [PageController::class,'contactUs'])->name('contact-us');
Route::get('auction', [PageController::class,'auction'])->name('auction');
Route::get('user-profile', [ProfileController::class,'index'])->name('user-profile');
Route::post('update-profile', [ProfileController::class,'updateProfile'])->name('update-profile');
Route::post('change-image', [ProfileController::class,'changeImage'])->name('change-image');
Route::get('add-auction', [AuctionController::class,'index'])->name('add-auction');
Route::get('add-car', [VehicleController::class,'create'])->name('add-car');
Route::post('add-vehicle-store', [VehicleController::class,'store'])->name('add-vehicle-store');
Route::post('vehicle-image-upload', [VehicleController::class,'imageUpload'])->name('vehicle-image-upload');
Route::post('vehicle-document-upload', [VehicleController::class,'documentUpload'])->name('vehicle-document-upload');
Route::delete('vehicle-image-delete/{temp_time}', [VehicleController::class,'imageDelete'])->name('vehicle-image-delete');
Route::delete('vehicle-document-delete/{temp_time}', [VehicleController::class,'documentDelete'])->name('vehicle-document-delete');
Route::post('vehicle-bid-store', [BidController::class,'addBid'])->name('vehicle-bid-store');

Route::get('vehicle-bid-listing/{id}', [AuctionController::class, 'vehicleBidListing'])->name('vehicle-bid-listing');
Route::get('updated-bid/{id}', [AuctionController::class, 'updatedBid'])->name('updated-bid');

Route::post('send-mail', [LoginController::class, 'sendMail'])->name('send-mail');
Route::get('reset-password/{token}', [LoginController::class, 'resetPassword'])->name('reset-password');
Route::post('reset-password-submit', [LoginController::class, 'resetPasswordSubmit'])->name('reset-password-submit');

