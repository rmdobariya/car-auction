<?php

use App\Http\Controllers\Api\V1\BidController;
use App\Http\Controllers\Api\V1\ContactusController;
use App\Http\Controllers\Api\V1\LanguageStringController;
use App\Http\Controllers\Api\V1\MyAuctionController;
use App\Http\Controllers\Api\V1\NotificationController;
use App\Http\Controllers\Api\V1\PageController;
use App\Http\Controllers\Api\V1\BlogController;
use App\Http\Controllers\Api\V1\FaqController;
use App\Http\Controllers\Api\V1\LoginController;
use App\Http\Controllers\Api\V1\ProfileController;
use App\Http\Controllers\Api\V1\QuestionController;
use App\Http\Controllers\Api\V1\SearchController;
use App\Http\Controllers\Api\V1\SettingController;
use App\Http\Controllers\Api\V1\TestimonialController;
use App\Http\Controllers\Api\V1\VehicleCategoryController;
use App\Http\Controllers\Api\V1\VehicleController;
use App\Http\Controllers\Api\V1\WishListController;
use Illuminate\Support\Facades\Route;


Route::group(['prefix' => 'v1', 'as' => 'api.v1.', 'middleware' => ['apiLanguageCheck']], function () {
    Route::post('login', [LoginController::class,'login'])->name('login');
    Route::post('register', [LoginController::class,'register'])->name('register');
    Route::post('forgotPassword', [ProfileController::class, 'forgotPassword'])->name('forgotPassword');
    Route::get('setting', [SettingController::class, 'index'])->name('setting');
    Route::get('page', [PageController::class, 'index'])->name('page');
    Route::get('pageDetail/{id}', [PageController::class, 'show'])->name('pageDetail');
    Route::get('faq', [FaqController::class, 'index'])->name('faq');
    Route::get('testimonial', [TestimonialController::class, 'index'])->name('testimonial');
    Route::get('blog', [BlogController::class, 'index'])->name('blog');
    Route::post('search', [SearchController::class, 'index'])->name('search');
    Route::get('language-string', [LanguageStringController::class, 'index'])->name('language-string');
    Route::post('ask-question', [QuestionController::class, 'index'])->name('ask-question');
    Route::get('contact-us', [ContactusController::class, 'index'])->name('contact-us');
    Route::post('contact-us-submit', [ContactusController::class, 'store'])->name('contact-us-submit');
    Route::get('get-vehicle', [VehicleController::class, 'index'])->name('get-vehicle');
    Route::get('get-pending-vehicle', [VehicleController::class, 'pendingVehicle'])->name('get-pending-vehicle');
    Route::get('get-vehicle-detail/{id}', [VehicleController::class, 'show'])->name('get-vehicle-detail');
    Route::get('get-vehicle-category', [VehicleCategoryController::class, 'index'])->name('get-vehicle-category');
    Route::group(['middleware' => ['auth:sanctum']], function () {
        Route::get('getProfile', [ProfileController::class, 'getProfile'])->name('getProfile');
        Route::post('updateProfile', [ProfileController::class, 'updateProfile'])->name('updateProfile');
        Route::post('updatePassword', [ProfileController::class, 'updatePassword'])->name('updatePassword');
        Route::post('store-vehicle', [VehicleController::class, 'store'])->name('store-vehicle');
        Route::post('change-status-vehicle/{id}', [VehicleController::class, 'changeStatus'])->name('change-status-vehicle');
        Route::delete('delete-vehicle/{id}', [VehicleController::class, 'destroy'])->name('delete-vehicle');
        Route::get('vehicle-document-remove/{id}', [VehicleController::class, 'removeDocument'])->name('vehicle-document-remove');
        Route::get('vehicle-image-remove/{id}', [VehicleController::class, 'removeImage'])->name('vehicle-image-remove');
        Route::get('bid', [BidController::class, 'index'])->name('bid');
        Route::get('my-bid', [BidController::class, 'myBid'])->name('my-bid');
        Route::get('my-wining', [BidController::class, 'myWining'])->name('my-wining');
        Route::post('place-bid', [BidController::class, 'placeBid'])->name('place-bid');
        Route::get('bid-detail/{id}', [BidController::class, 'show'])->name('bid-detail');
        Route::get('my-auction', [MyAuctionController::class, 'index'])->name('my-auction');
        Route::post('add-wish-list', [WishListController::class, 'store'])->name('add-wish-list');
        Route::get('get-wish-list', [WishListController::class, 'index'])->name('get-wish-list');
        Route::get('notification', [NotificationController::class, 'index'])->name('notification');
    });
});
