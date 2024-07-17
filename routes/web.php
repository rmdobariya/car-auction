<?php

use App\Http\Controllers\Web\AuctionController;
use App\Http\Controllers\Web\BidController;
use App\Http\Controllers\Web\HomeController;
use App\Http\Controllers\Web\LanguageController;
use App\Http\Controllers\Web\LoginController;
use App\Http\Controllers\Web\NotificationController;
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
Route::group(['middleware' => ['websiteLanguageCheck']], function () {
    Route::get('/', [HomeController::class, 'index'])->name('/');
    Route::post('home', [HomeController::class, 'index'])->name('home');
    Route::post('/login', [LoginController::class, 'loginCheck'])->name('/login');
    Route::post('/register', [LoginController::class, 'register'])->name('/register');
    Route::get('/logout', [LoginController::class, 'logout'])->name('/logout');
    Route::get('language/{code}', [LanguageController::class, 'changeLanguage'])->name('language');
    Route::get('vehicle-details/{id}', [HomeController::class, 'vehicleDetail'])->name('vehicle-details');
    Route::get('vehicle-detail/{id}', [HomeController::class, 'homeVehicleDetail'])->name('vehicle-detail');
    Route::get('car-inquiry/{id}', [HomeController::class, 'vehicleInquiry'])->name('car-inquiry');
    Route::get('vehicle-bid-modal/{id}', [HomeController::class, 'vehicleBid'])->name('vehicle-bid-modal');
    Route::get('payment-proof-modal/{id}', [HomeController::class, 'paymentProof'])->name('payment-proof-modal');
    Route::get('type-wise-car/{flag}', [HomeController::class, 'typeWiseCar'])->name('type-wise-car');
    Route::get('car-for-sell/{flag}', [HomeController::class, 'carForSell'])->name('car-for-sell');
    Route::get('seller/{id}', [HomeController::class, 'seller'])->name('seller');
    Route::get('corporate-seller-page', [HomeController::class, 'corporateSellerPage'])->name('corporate-seller-page');
    Route::post('render-corporate-seller', [HomeController::class, 'renderCorporateSellerPage'])->name('render-corporate-seller');
//Route::get('socialAccount', [SocialLoginController::class,'socialAccount'])->name('socialAccount');
    Route::get('googleCallback', [SocialLoginCOntroller::class, 'googleCallback'])->name('googleCallback');
    Route::get('newDetail/{id}', [HomeController::class, 'newDetail'])->name('newDetail');
    Route::get('facebookCallback', [SocialLoginController::class, 'facebookCallback'])->name('facebookCallback');
    Route::get('socialLogin/{type}', [SocialLoginController::class, 'socialLogin'])->name('socialLogin');
    Route::get('page/{slug}', [PageController::class, 'index'])->name('page');
    Route::get('contact-us', [PageController::class, 'contactUs'])->name('contact-us');
    Route::get('auction', [PageController::class, 'auction'])->name('auction');
    Route::get('user-profile', [ProfileController::class, 'index'])->name('user-profile');
    Route::post('update-profile', [ProfileController::class, 'updateProfile'])->name('update-profile');
    Route::post('change-image', [ProfileController::class, 'changeImage'])->name('change-image');
    Route::post('update-password', [ProfileController::class, 'updatePassword'])->name('update-password');
    Route::get('add-auction', [AuctionController::class, 'index'])->name('add-auction');
    Route::get('add-car', [VehicleController::class, 'create'])->name('add-car');
    Route::get('edit-car/{id}', [VehicleController::class, 'edit'])->name('edit-car');
    Route::post('add-vehicle-store', [VehicleController::class, 'store'])->name('add-vehicle-store');
    Route::post('vehicle-image-upload', [VehicleController::class, 'imageUpload'])->name('vehicle-image-upload');
    Route::post('vehicle-document-upload', [VehicleController::class, 'documentUpload'])->name('vehicle-document-upload');
    Route::delete('vehicle-image-delete/{temp_time}', [VehicleController::class, 'imageDelete'])->name('vehicle-image-delete');
    Route::delete('vehicle-document-delete/{temp_time}', [VehicleController::class, 'documentDelete'])->name('vehicle-document-delete');
    Route::post('getVehicleGallery', [VehicleController::class, 'getVehicleGallery'])->name('getVehicleGallery');
    Route::post('getVehicleDocument', [VehicleController::class, 'getVehicleDocument'])->name('getVehicleDocument');
    Route::get('deleteVehicleImage/{id}', [VehicleController::class, 'deleteVehicleImage'])->name('deleteVehicleImage');
    Route::get('deleteVehicleDocument/{id}', [VehicleController::class, 'deleteVehicleDocument'])->name('deleteVehicleDocument');
    Route::get('deleteCar/{id}', [VehicleController::class, 'destroy'])->name('deleteCar');
    Route::post('vehicle-bid-store', [BidController::class, 'addBid'])->name('vehicle-bid-store');
    Route::post('payment-proof-store', [BidController::class, 'paymentProofStore'])->name('payment-proof-store');
    Route::post('vehicle-inquiry-store', [HomeController::class, 'carInquirySubmit'])->name('vehicle-inquiry-store');
    Route::post('contact-us-store', [HomeController::class, 'contactUsSubmit'])->name('contact-us-store');

    Route::get('vehicle-bid-listing/{id}', [AuctionController::class, 'vehicleBidListing'])->name('vehicle-bid-listing');
    Route::post('search-car', [AuctionController::class, 'searchCar'])->name('search-car');
    Route::get('updated-bid/{id}', [BidController::class, 'updatedBid'])->name('updated-bid');
    Route::get('notification', [NotificationController::class, 'index'])->name('notification');
    Route::get('notification-delete/{id}', [NotificationController::class, 'destroy'])->name('notification-delete');

    Route::post('send-mail', [LoginController::class, 'sendMail'])->name('send-mail');
    Route::get('reset-password/{token}', [LoginController::class, 'resetPassword'])->name('reset-password');
    Route::post('reset-password-submit', [LoginController::class, 'resetPasswordSubmit'])->name('reset-password-submit');
    Route::post('wish-list', [HomeController::class, 'wishList'])->name('wish-list');
    Route::get('filter', [HomeController::class, 'filter'])->name('filter');
    Route::post('add-question-store', [HomeController::class, 'addQuestionStore'])->name('add-question-store');
    Route::get('wishlist', [PageController::class, 'wishListPage'])->name('wishlist');
    Route::get('my-bids', [HomeController::class, 'myBids'])->name('my-bids');
    Route::get('my-winnings', [HomeController::class, 'myWinnings'])->name('my-winnings');

});
