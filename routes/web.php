<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\BrandProduct;
use App\Http\Controllers\CartController;
use App\Http\Controllers\CategoryProduct;
use App\Http\Controllers\CouponController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProductController;
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

Route::get('/', [HomeController::class, 'index']);


Route::get('/trang-chu', [HomeController::class, 'index']);
Route::get('/admin', [AdminController::class, 'index']);
Route::get('/dashboard', [AdminController::class, 'show_dashboard']);
Route::post('/admin-dashboard', [AdminController::class, 'dashboard']);
Route::get('/logout', [AdminController::class, 'logout']);

// danh mục sản phẩm - home
Route::get('/danh-muc-san-pham/{category_id}', [CategoryProduct::class, 'show_category_home']);

// thương hiệu sản phẩm - home
Route::get('/thuong-hieu-san-pham/{brand_id}', [BrandProduct::class, 'show_brand_home']);

// Chi tiết sản phẩm - home
Route::get('/chi-tiet-san-pham/{product_id}', [ProductController::class, 'show_detail_product']);

// Category Product
Route::get('/all-category-product', [CategoryProduct::class, 'all_category_product']);
Route::get('/add-category-product', [CategoryProduct::class, 'add_category_product']);
Route::post('/save-category-product', [CategoryProduct::class, 'save_category_product']);
Route::get('/edit-category-product/{category_product_id}', [CategoryProduct::class, 'edit_category_product']);
Route::get('/delete-category-product/{category_product_id}', [CategoryProduct::class, 'delete_category_product']);
Route::post('/update-category-product/{category_product_id}', [CategoryProduct::class, 'update_category_product']);

Route::get('/unactive-category-product/{category_product_id}', [CategoryProduct::class, 'unactive_category_product']);
Route::get('/active-category-product/{category_product_id}', [CategoryProduct::class, 'active_category_product']);

// Brands Product
Route::get('/all-brand-product', [BrandProduct::class, 'all_brand_product']);
Route::get('/add-brand-product', [BrandProduct::class, 'add_brand_product']);
Route::post('/save-brand-product', [BrandProduct::class, 'save_brand_product']);
Route::get('/edit-brand-product/{brand_product_id}', [BrandProduct::class, 'edit_brand_product']);
Route::get('/delete-brand-product/{brand_product_id}', [BrandProduct::class, 'delete_brand_product']);
Route::post('/update-brand-product/{brand_product_id}', [BrandProduct::class, 'update_brand_product']);

Route::get('/unactive-brand-product/{brand_product_id}', [BrandProduct::class, 'unactive_brand_product']);
Route::get('/active-brand-product/{brand_product_id}', [BrandProduct::class, 'active_brand_product']);

// Product
Route::get('/all-product', [ProductController::class, 'all_product']);
Route::get('/add-product', [ProductController::class, 'add_product']);
Route::post('/save-product', [ProductController::class, 'save_product']);
Route::get('/edit-product/{product_id}', [ProductController::class, 'edit_product']);
Route::get('/delete-product/{product_id}', [ProductController::class, 'delete_product']);
Route::post('/update-product/{product_id}', [ProductController::class, 'update_product']);

Route::get('/unactive-product/{product_id}', [ProductController::class, 'unactive_product']);
Route::get('/active-product/{product_id}', [ProductController::class, 'active_product']);

// CART
Route::post('/save-cart', [CartController::class, 'save_cart']);
Route::post('/add-cart-ajax', [CartController::class, 'add_cart_ajax']);
Route::get('/gio-hang', [CartController::class, 'gio_hang']);
Route::post('/update-cart-quantity', [CartController::class, 'update_cart_quantity']);
Route::get('/delete-cart-product/{session_id}', [CartController::class, 'delete_cart_product']);
Route::get('/delete-all-cart', [CartController::class, 'delete_all_cart']);
// Coupon cart user
Route::post('/check-coupon', [CartController::class, 'check_coupon']);
Route::get('/unset-coupon', [CouponController::class, 'unset_coupon']);
//Coupon Admin
Route::get('/list-coupon', [CouponController::class, 'list_coupon']);  // list coupon
Route::get('/delete-coupon/{coupon_id}', [CouponController::class, 'delete_coupon']);  // list coupon
Route::get('/insert-coupon', [CouponController::class, 'insert_coupon']);  // chuyển đến trang thêm
Route::post('/insert-coupon-code', [CouponController::class, 'insert_coupon_code']);  // hàm thêm code