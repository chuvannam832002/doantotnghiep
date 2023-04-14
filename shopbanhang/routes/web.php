<?php

use Illuminate\Support\Facades\Route;

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
//frontend
Route::get('/', 'App\Http\Controllers\HomeController@index');
Route::get('/trang-chu', 'App\Http\Controllers\HomeController@index');
Route::post('/tim-kiem', 'App\Http\Controllers\HomeController@search');
//Danh muc san pham trang chu
Route::get('/danhmucsanpham/{category_id}', 'App\Http\Controllers\CategoryProduct@show_category_home');
Route::get('/thuonghieusanpham/{brand_id}', 'App\Http\Controllers\BrandProduct@show_brand_home');
Route::get('/chitietsanpham/{product_id}', 'App\Http\Controllers\ProductController@detail_product');
//backend
Route::get('/admin', 'App\Http\Controllers\AdminController@index');
Route::get('/dashboard', 'App\Http\Controllers\AdminController@showdashboard');
Route::post('/admin-dashboard', 'App\Http\Controllers\AdminController@dashboard');
Route::get('/logout', 'App\Http\Controllers\AdminController@logout');
//CategoryProduct
Route::get('/add-category-product', 'App\Http\Controllers\CategoryProduct@add_category_product');
Route::get('/edit-category-product/{category_product_id}', 'App\Http\Controllers\CategoryProduct@edit_category_product');
Route::get('/delete-category-product/{category_product_id}', 'App\Http\Controllers\CategoryProduct@delete_category_product');
Route::get('/all-category-product', 'App\Http\Controllers\CategoryProduct@all_category_product');
Route::get('/active-category-product/{category_product_id}', 'App\Http\Controllers\CategoryProduct@active_category_product');
Route::get('/unactive-category-product/{category_product_id}', 'App\Http\Controllers\CategoryProduct@unactive_category_product');
Route::post('/save-category-product', 'App\Http\Controllers\CategoryProduct@save_category_product');
Route::post('/update-category-product/{category_product_id}', 'App\Http\Controllers\CategoryProduct@update_category_product');
//Login facebook
Route::get('/login-facebook','App\Http\Controllers\LoginController@login_facebook');
Route::get('/admin/callback','App\Http\Controllers\LoginController@callback_facebook');
//BrandProduct
Route::get('/add-brand-product', 'App\Http\Controllers\BrandProduct@add_brand_product');
Route::get('/edit-brand-product/{brand_product_id}', 'App\Http\Controllers\BrandProduct@edit_brand_product');
Route::get('/delete-brand-product/{brand_product_id}', 'App\Http\Controllers\BrandProduct@delete_brand_product');
Route::get('/all-brand-product', 'App\Http\Controllers\BrandProduct@all_brand_product');
Route::get('/active-brand-product/{brand_product_id}', 'App\Http\Controllers\BrandProduct@active_brand_product');
Route::get('/unactive-brand-product/{brand_product_id}', 'App\Http\Controllers\BrandProduct@unactive_brand_product');
Route::post('/save-brand-product', 'App\Http\Controllers\BrandProduct@save_brand_product');
Route::post('/update-brand-product/{brand_product_id}', 'App\Http\Controllers\BrandProduct@update_brand_product');
//Product
Route::get('/add-product', 'App\Http\Controllers\ProductController@add_product');
Route::get('/edit-product/{product_id}', 'App\Http\Controllers\ProductController@edit_product');
Route::get('/delete-product/{product_id}', 'App\Http\Controllers\ProductController@delete_product');
Route::get('/all-product', 'App\Http\Controllers\ProductController@all_product');
Route::get('/active-product/{product_id}', 'App\Http\Controllers\ProductController@active_product');
Route::get('/unactive-product/{product_id}', 'App\Http\Controllers\ProductController@unactive_product');
Route::post('/save-product', 'App\Http\Controllers\ProductController@save_product');
Route::post('/update-product/{product_id}', 'App\Http\Controllers\ProductController@update_product');
//Cart
Route::post('/save-cart', 'App\Http\Controllers\CartController@save_cart');
Route::post('/add-cart-ajax', 'App\Http\Controllers\CartController@add_cart_ajax');
Route::post('/update-cart-quantity', 'App\Http\Controllers\CartController@update_cart_quantity');
Route::get('/show-cart', 'App\Http\Controllers\CartController@show_cart');
Route::get('/show-cart', 'App\Http\Controllers\CartController@show_cart');
Route::get('/delete-to-cart/{rowId}', 'App\Http\Controllers\CartController@delete_cart');
//login-checkout
Route::get('/login-checkout', 'App\Http\Controllers\CheckoutController@login_checkout');
Route::get('/logout-checkout', 'App\Http\Controllers\CheckoutController@logout_checkout');
Route::get('/checkout', 'App\Http\Controllers\CheckoutController@checkout');
Route::get('/payment', 'App\Http\Controllers\CheckoutController@payment');
Route::post('/add-customer', 'App\Http\Controllers\CheckoutController@add_customer');
Route::post('/order-place', 'App\Http\Controllers\CheckoutController@order_place');
Route::post('/login-customer', 'App\Http\Controllers\CheckoutController@login_customer');
Route::post('/save-checkout-customer', 'App\Http\Controllers\CheckoutController@save_checkout_customer');
//order
Route::get('/manage-order', 'App\Http\Controllers\CheckoutController@manage_order');
Route::get('/view-order/{orderId}', 'App\Http\Controllers\CheckoutController@view_order');
Route::get('/delete-order/{orderId}', 'App\Http\Controllers\CheckoutController@delete_order');
