<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\SliderController;
use App\Http\Controllers\Admin\ContactController;

use App\Http\Controllers\Admin\ReviewController;
use App\Http\Controllers\Admin\SiteInfoController;
use App\Http\Controllers\Admin\ProductCartController;
use App\Http\Controllers\Admin\ProductListController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::middleware(['auth:sanctum', config('jetstream.auth_session'), 'verified'])->group(function () {
    Route::get('/dashboard', function() {
        return view('admin.index');
    })->name('dashboard');
});

//Admin Logout Routes
Route::get('/logout', [AdminController::class, 'AdminLogout'])->name('admin-logout');

Route::prefix('admin')->group(function(){
    //Profile Route
    Route::get('/user/profile', [AdminController::class, 'UserProfile'])->name('user-profile');

    //Profile Store Route
    Route::post('/user/profile/store', [AdminController::class, 'UserProfileStore'])->name('user-profile-store');

     //Change Password Route
     Route::get('/change/password', [AdminController::class, 'ChangePassword'])->name('change-password');

     //Change Store Route
     Route::post('/change/password/update', [AdminController::class, 'ChangePasswordUpdate'])->name('change-password-update');
});

///////////// Start of Category All Routes. ////////////////
Route::prefix('category')->group(function(){
    //All Category Route
    Route::get('/all',[CategoryController::class, 'GetAllCategory'])->name('all-category');

    //Add Category Route
    Route::get('/add',[CategoryController::class, 'AddCategory'])->name('add-category');

    //store Category Route
    Route::post('/store',[CategoryController::class, 'StoreCategory'])->name('category-store');

    //edit Category Route
    Route::get('/edit/{id}',[CategoryController::class, 'EditCategory'])->name('category-edit');

    //update Category Route
    Route::post('/update',[CategoryController::class, 'UpdateCategory'])->name('category-update');

     //delete Category Route
    Route::get('/delete/{id}',[CategoryController::class, 'DeleteCategory'])->name('category-delete');
}); ///////////// end of Sub Category All Methods. ////////////////

///////////// Start of Sub Category All Routes. ////////////////
Route::prefix('subcategory')->group(function(){
    Route::get('/all',[CategoryController::class, 'GetAllSubCategory'])->name('all-subcategory');

    Route::get('/add',[CategoryController::class, 'AddSubCategory'])->name('add-subcategory');

    Route::post('/store',[CategoryController::class, 'StoreSubCategory'])->name('subcategory-store');

    Route::get('/edit/{id}',[CategoryController::class, 'EditSubCategory'])->name('subcategory-edit');

    Route::post('/update',[CategoryController::class, 'UpdateSubCategory'])->name('subcategory-update');

    Route::get('/delete/{id}',[CategoryController::class, 'DeleteSubCategory'])->name('subcategory-delete');
}); ///////////// end Sub Category All Methods. ////////////////

 ///////////// start slider All Methods. ////////////////
Route::prefix('slider')->group(function(){
    Route::get('/all',[SliderController::class, 'GetAllSlider'])->name('all-slider');

    Route::get('/add',[SliderController::class, 'AddSlider'])->name('add-slider');

    Route::post('/store',[SliderController::class, 'StoreSlider'])->name('slider-store');

    Route::get('/edit/{id}',[SliderController::class, 'EditSlider'])->name('slider-edit');

    Route::post('/update',[SliderController::class, 'UpdateSlider'])->name('slider-update');

    Route::get('/delete/{id}',[SliderController::class, 'DeleteSlider'])->name('slider-delete');
});  ///////////// end Slider All Methods. ////////////////

///////////// start product All Methods. ////////////////
Route::prefix('product')->group(function(){
    Route::get('/all',[ProductListController::class, 'GetAllProduct'])->name('all-product');

    Route::get('/add',[ProductListController::class, 'AddProduct'])->name('add-product');

    Route::post('/store',[ProductListController::class, 'StoreProduct'])->name('product-store');

    Route::get('/edit/{id}',[ProductListController::class, 'EditProduct'])->name('product-edit');

    Route::post('/update',[ProductListController::class, 'UpdateProduct'])->name('product-update');

    Route::get('/delete/{id}',[ProductListController::class, 'DeleteProduct'])->name('product-delete');

    Route::get('/get-subcategories', [ProductListController::class, 'getSubcategoriesByCategory'])->name('get-subcategories');
});  ///////////// end product All Methods. ////////////////

/// Contact Message Route 
Route::get('/all/message',[ContactController::class, 'GetAllMessage'])->name('contact-message');
Route::get('/message/delete/{id}',[ContactController::class, 'DeleteMessage'])->name('message-delete');

/// Product Review Route 
Route::get('/all/review',[ReviewController::class, 'GetAllReview'])->name('all-review');
Route::get('/review/delete/{id}',[ReviewController::class, 'DeleteReview'])->name('review-delete');


/// Site Info Route 
Route::get('/getsite/info',[SiteInfoController::class, 'GetSiteInfo'])->name('getsite-info');
Route::post('/update/siteinfo',[SiteInfoController::class, 'UpdateSiteInfo'])->name('update-siteinfo');

///////////// start product orders All Methods. ////////////////
Route::prefix('order')->group(function(){
    Route::get('/pending',[ProductCartController::class, 'PendingOrder'])->name('pending-order');

    Route::get('/processing',[ProductCartController::class, 'ProcessingOrder'])->name('processing-order');

    Route::get('/complete',[ProductCartController::class, 'CompleteOrder'])->name('complete-order');

    Route::get('/details/{id}',[ProductCartController::class, 'OrderDetails'])->name('order-details');

    Route::get('/status/processing/{id}',[ProductCartController::class, 'PendingToProcessing'])->name('pending-processing');

    Route::get('/status/complete/{id}',[ProductCartController::class, 'ProcessingToComplete'])->name('processing-complete');

    Route::get('/status/delete/{id}',[ProductCartController::class, 'DeleteCompleteOrder'])->name('order-delete');
}); ///////////// end product orders All Methods. ////////////////