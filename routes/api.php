<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\VisitorController;
use App\Http\Controllers\Admin\ContactController;
use App\Http\Controllers\Admin\SiteInfoController;
use App\Http\Controllers\Admin\CategoryController;

use App\Http\Controllers\Admin\ProductListController;
use App\Http\Controllers\Admin\SliderController;
use App\Http\Controllers\Admin\ProductDetailsController;
use App\Http\Controllers\Admin\NotificationController;
use App\Http\Controllers\Admin\ReviewController;
use App\Http\Controllers\Admin\ProductCartController;
use App\Http\Controllers\Admin\FavouriteController;

use App\Http\Controllers\User\AuthController;
use App\Http\Controllers\User\ForgetController;
use App\Http\Controllers\User\ResetController;
use App\Http\Controllers\User\UserController;


///////////// Start User Login Auth Api ///////////////////

//Authentication Routes
Route::post('/login', [AuthController::class, 'Login']);
Route::post('/register', [AuthController::class, 'Register']);

//Forget Password Routes
Route::post('/forgetpassword', [ForgetController::class, 'ForgetPassword']);

//Forget Password Routes
Route::post('/resetpassword', [ResetController::class, 'ResetPassword']);

//Current user Route
Route::get('/user', [UserController::class, 'User'])->middleware('auth:api');

///////////// End User Login Auth Api ////////////////////


// Get Visitor
Route::get('/getvisitor',[VisitorController::class, 'GetVisitorDetails']);

// Contact Page Route
Route::post('/postcontact',[ContactController::class, 'PostContactDetails']);

// Site Infro Route
Route::get('/allsiteinfo',[SiteInfoController::class, 'AllSiteinfo']);

// All Category Route
Route::get('/allcategory',[CategoryController::class, 'AllCategory']);

// ProductList Route
Route::get('/productlistbyremark/{remark}',[ProductListController::class, 'ProductListByRemark']);

Route::get('/productlistbycategory/{category}',[ProductListController::class, 'ProductListByCategory']);

Route::get('/productlistbysubcategory/{category}/{subcategory}',[ProductListController::class, 'ProductListBySubCategory']);

// Slider Route
Route::get('/allslider',[SliderController::class, 'AllSlider']);

// Product Details Route
Route::get('/productdetails/{id}',[ProductDetailsController::class, 'ProductDetails']);

// Notification Route
Route::get('/notification',[NotificationController::class, 'NotificationHistory']);

// Search Route
Route::get('/search/{key}',[ProductListController::class, 'ProductBySearch']);

// Similar Product Route
Route::get('/similar/{subcategory}',[ProductListController::class, 'SimilarProduct']);


// Product Cart Route
Route::post('/addtocart',[ProductCartController::class, 'addToCart']);

// Cart Count Route
Route::get('/cartcount/{product_code}',[ProductCartController::class, 'CartCount']);

//Favourite Count Route
Route::get('/favcount/{email}',[FavouriteController::class, 'FavCount']);

//Edit/Update Products
// Route::post('/update',[ProductListController::class, 'UpdateProduct'])->name('product-update');


// Favourite Route
Route::get('/favourite/{product_code}/{email}',[FavouriteController::class, 'AddFavourite']);

Route::get('/favouritelist/{email}',[FavouriteController::class, 'FavouriteList']);

Route::get('/favouriteremove/{product_code}/{email}',[FavouriteController::class, 'FavouriteRemove']);

// Cart List Route
Route::get('/cartlist/{email}',[ProductCartController::class, 'CartList']);

Route::get('/removecartlist/{id}',[ProductCartController::class, 'RemoveCartList']);

Route::get('/cartitemplus/{id}/{quantity}/{price}',[ProductCartController::class, 'CartItemPlus']);

Route::get('/cartitemminus/{id}/{quantity}/{price}',[ProductCartController::class, 'CartItemMinus']);


// Cart Order Route
Route::post('/cartorder',[ProductCartController::class, 'CartOrder']);

Route::get('/orderlistbyuser/{email}',[ProductCartController::class, 'OrderListByUser']);

// Post Product Review Route
Route::post('/postreview',[ReviewController::class, 'PostReview']);

//Product Review route
Route::get('/review-list/{product_code}', [ReviewController::class, 'ReviewList']);


// Route::prefix('product')->group(function(){
//   Route::get('/all',[ProductListController::class, 'GetAllProduct'])->name('all-product');

//   Route::post('/store',[ProductListController::class, 'StoreProduct'])->name('product-store');

//   Route::post('/update',[ProductListController::class, 'UpdateProduct'])->name('product-update');
// });