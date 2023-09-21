<?php

use App\Http\Controllers\Admin\BannerController;
use App\Http\Controllers\Admin\BlogController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\ContactUsController;
use App\Http\Controllers\Admin\CustomerController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\FaqController;
use App\Http\Controllers\Admin\HomeController;
use App\Http\Controllers\Admin\LoginController;
use App\Http\Controllers\Admin\PasswordController;
use App\Http\Controllers\Admin\PermissionController;
use App\Http\Controllers\Admin\ProfileController;
use App\Http\Controllers\Admin\RoleController;
use App\Http\Controllers\Admin\SettingController;
use App\Http\Controllers\Admin\PageController;
use App\Http\Controllers\Admin\TestimonialController;
use App\Http\Controllers\Admin\VehicleController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Admin Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/
//dd(123);
Route::get('/', [LoginController::class, 'index'])->name('login');
Route::get('/login', [LoginController::class, 'index'])->name('login');
Route::post('/login-check', [LoginController::class, 'loginCheck'])->name('login-check');
Route::post('send-mail', [PasswordController::class, 'sendMail'])->name('send-mail');
Route::get('reset-password/{token}', [PasswordController::class, 'resetPassword'])->name('reset-password');
Route::post('reset-password-submit', [PasswordController::class, 'resetPasswordSubmit'])->name('reset-password-submit');
Route::group(['middleware' => ['auth:admin', 'adminCheck']], function () {
    Route::get('logout', [LoginController::class, 'logout'])->name('logout');
    Route::get('my-profile', [ProfileController::class, 'index'])->name('my-profile');
    Route::post('updateProfile', [ProfileController::class, 'updateProfile'])->name('updateProfile');
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::get('change-panel-mode/{id}', [HomeController::class, 'changePanelMode'])->name('change-panel-mode');
    Route::get('/change-password', [PasswordController::class, 'index'])->name('change-password');
    Route::post('update-password', [PasswordController::class, 'updatePassword'])->name('update-password');

    Route::resource('setting', SettingController::class);
    Route::post('general-setting-store', [SettingController::class, 'generalSettingStore'])->name('general-setting-store');
    Route::post('email-setting-store', [SettingController::class, 'emailSettingStore'])->name('email-setting-store');
    Route::post('app-setting-store', [SettingController::class, 'appSettingStore'])->name('app-setting-store');
    Route::post('contact-info-store', [SettingController::class, 'contactInfoStore'])->name('contact-info-store');
    Route::post('social-media-store', [SettingController::class, 'socialMediaStore'])->name('social-media-store');

    Route::resource('page', PageController::class);
    Route::get('get-page-list', [PageController::class, 'getPageList'])->name('get-page-list');
    Route::get('page/status/{id}/{status}', [PageController::class, 'changeStatus'])->name('page.status.change');
    Route::post('multiple-page-delete', [PageController::class, 'multiplePageDelete'])->name('multiple-page-delete');

    Route::resource('customer', CustomerController::class);
    Route::get('get-customer-list', [CustomerController::class, 'getCustomerList'])->name('get-customer-list');
    Route::get('customer/status/{id}/{status}', [CustomerController::class, 'changeStatus'])->name('customer.status.change');
    Route::post('multiple-user-delete', [CustomerController::class, 'multipleUserDelete'])->name('multiple-user-delete');
    Route::get('restore-customer/{id}', [CustomerController::class, 'restoreCustomer'])->name('restore-customer');
    Route::delete('hard-delete/{id}', [CustomerController::class, 'hardDelete'])->name('hard-delete');

    Route::resource('faq', FaqController::class);
    Route::get('get-faq-list', [FaqController::class, 'getFaqList'])->name('get-faq-list');
    Route::get('faq/status/{id}/{status}', [FaqController::class, 'changeStatus'])->name('faq.status.change');
    Route::get('restore-faq/{id}', [FaqController::class, 'restore'])->name('restore-faq');
    Route::delete('hard-delete/{id}', [FaqController::class, 'hardDelete'])->name('hard-delete');
    Route::post('multiple-faq-delete', [FaqController::class, 'multipleFaqDelete'])->name('multiple-faq-delete');

    Route::resource('news', BLogController::class);
    Route::get('get-news-list', [BLogController::class, 'getBlogList'])->name('get-news-list');
    Route::get('news/status/{id}/{status}', [BLogController::class, 'changeStatus'])->name('news.status.change');
    Route::get('restore-news/{id}', [BLogController::class, 'restore'])->name('restore-news');
    Route::delete('hard-delete/{id}', [BLogController::class, 'hardDelete'])->name('hard-delete');
    Route::post('multiple-news-delete', [BLogController::class, 'multipleBlogDelete'])->name('multiple-news-delete');

    Route::resource('testimonial', TestimonialController::class);
    Route::get('get-testimonial-list', [TestimonialController::class, 'getTestimonialList'])->name('get-testimonial-list');
    Route::get('testimonial/status/{id}/{status}', [TestimonialController::class, 'changeStatus'])->name('testimonial.status.change');
    Route::get('restore-testimonial/{id}', [TestimonialController::class, 'restore'])->name('restore-testimonial');
    Route::delete('hard-delete/{id}', [TestimonialController::class, 'hardDelete'])->name('hard-delete');
    Route::post('multiple-testimonial-delete', [TestimonialController::class, 'multipleTestimonialDelete'])->name('multiple-testimonial-delete');

    Route::resource('role', RoleController::class);
    Route::get('get-role-list', [RoleController::class, 'getRoleList'])->name('get-role-list');

    /* Permission Routes */
    Route::resource('permission', PermissionController::class);
    Route::get('get-permission-list', [PermissionController::class, 'getPermissionList'])->name('get-permission-list');

    Route::resource('contact-us', ContactUsController::class);
    Route::get('get-contact-us-list', [ContactUsController::class, 'getContactUsList'])->name('get-contact-us-list');
    Route::get('restore-contact-us/{id}', [ContactUsController::class, 'restore'])->name('restore-contact-us');
    Route::delete('hard-delete/{id}', [ContactUsController::class, 'hardDelete'])->name('hard-delete');
    Route::post('multiple-contact-us-delete', [ContactUsController::class, 'multipleContactUsDelete'])->name('multiple-contact-us-delete');

    Route::resource('category', CategoryController::class);
    Route::get('get-category-list', [CategoryController::class, 'getCategoryList'])->name('get-category-list');
    Route::get('restore-category/{id}', [CategoryController::class, 'restore'])->name('restore-category');
    Route::delete('hard-delete-category/{id}', [CategoryController::class, 'hardDelete'])->name('hard-delete-category');
    Route::post('multiple-category-delete', [CategoryController::class, 'multipleCategoryDelete'])->name('multiple-category-delete');
    Route::get('category/status/{id}/{status}', [CategoryController::class, 'changeStatus'])->name('category.status.change');

    Route::resource('vehicle', VehicleController::class);
    Route::get('get-vehicle-list', [VehicleController::class, 'getVehicleList'])->name('get-vehicle-list');
    Route::get('restore-vehicle/{id}', [VehicleController::class, 'restore'])->name('restore-vehicle');
    Route::delete('hard-delete/{id}', [VehicleController::class, 'hardDelete'])->name('hard-delete');
    Route::post('multiple-vehicle-delete', [VehicleController::class, 'multipleVehicleDelete'])->name('multiple-vehicle-delete');
    Route::get('vehicle/status/{id}/{status}', [VehicleController::class, 'changeStatus'])->name('vehicle.status.change');
    Route::post('vehicle-image-upload', [VehicleController::class,'imageUpload'])->name('vehicle-image-upload');
    Route::delete('vehicle-image-delete/{temp_time}', [VehicleController::class,'imageDelete'])->name('vehicle-image-delete');
    Route::post('getVehicleGallery', [VehicleController::class, 'getVehicleGallery'])->name('getVehicleGallery');
    Route::get('deleteVehicleImage/{id}', [VehicleController::class, 'deleteVehicleImage'])->name('deleteVehicleImage');

    Route::resource('banner', BannerController::class);
    Route::get('get-banner-list', [BannerController::class, 'getBannerList'])->name('get-banner-list');
    Route::get('restore-banner/{id}', [BannerController::class, 'restore'])->name('restore-banner');
    Route::delete('hard-delete-banner/{id}', [BannerController::class, 'hardDelete'])->name('hard-delete-banner');
    Route::get('banner/status/{id}/{status}', [BannerController::class, 'changeStatus'])->name('banner.status.change');
    Route::post('multiple-banner-delete', [BannerController::class, 'multipleBannerDelete'])->name('multiple-banner-delete');
});
