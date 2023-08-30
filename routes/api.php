<?php

use App\Http\Controllers\Api\V1\ContactusController;
use App\Http\Controllers\Api\V1\PageController;
use App\Http\Controllers\Api\V1\BlogController;
use App\Http\Controllers\Api\V1\FaqController;
use App\Http\Controllers\Api\V1\LoginController;
use App\Http\Controllers\Api\V1\ProfileController;
use App\Http\Controllers\Api\V1\SettingController;
use App\Http\Controllers\Api\V1\VehicleCategoryController;
use App\Http\Controllers\Api\V1\VehicleController;
use App\Http\Controllers\Api\V1\VehicleDocumentController;
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

Route::prefix('v1')->name('api.v1')->namespace('Api\V1')->group(function () {
    Route::post('login', [LoginController::class,'login'])->name('login');
    Route::post('register', [LoginController::class,'register'])->name('register');
    Route::post('forgotPassword', [ProfileController::class, 'forgotPassword'])->name('forgotPassword');
    Route::get('setting', [SettingController::class, 'index'])->name('setting');
    Route::get('page', [PageController::class, 'index'])->name('page');
    Route::get('pageDetail/{id}', [PageController::class, 'show'])->name('pageDetail');
    Route::get('faq', [FaqController::class, 'index'])->name('faq');
    Route::get('blog', [BlogController::class, 'index'])->name('blog');
    Route::group(['middleware' => ['auth:sanctum']], function () {
        Route::get('getProfile', [ProfileController::class, 'getProfile'])->name('getProfile');
        Route::post('updateProfile', [ProfileController::class, 'updateProfile'])->name('updateProfile');
        Route::post('updatePassword', [ProfileController::class, 'updatePassword'])->name('updatePassword');
        Route::post('contact-us-submit', [ContactusController::class, 'store'])->name('contact-us-submit');
        Route::get('contact-us', [ContactusController::class, 'index'])->name('contact-us');

        Route::post('store-vehicle-category', [VehicleCategoryController::class, 'store'])->name('store-vehicle-category');
        Route::get('get-vehicle-category', [VehicleCategoryController::class, 'index'])->name('get-vehicle-category');
        Route::delete('delete-vehicle-category/{id}', [VehicleCategoryController::class, 'destroy'])->name('delete-vehicle-category');

        Route::post('store-vehicle', [VehicleController::class, 'store'])->name('store-vehicle');
        Route::get('get-vehicle', [VehicleController::class, 'index'])->name('get-vehicle');
        Route::get('get-vehicle-detail/{id}', [VehicleController::class, 'show'])->name('get-vehicle-detail');
        Route::post('change-status-vehicle/{id}', [VehicleController::class, 'changeStatus'])->name('change-status-vehicle');
        Route::delete('delete-vehicle/{id}', [VehicleController::class, 'destroy'])->name('delete-vehicle');

        Route::post('vehicle-document-upload', [VehicleDocumentController::class, 'documentUpload'])->name('vehicle-document-upload');
        Route::get('vehicle-document-remove/{id}', [VehicleDocumentController::class, 'removeDocument'])->name('vehicle-document-remove');
    });
});
