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
Route::post('/quickview', 'App\Http\Controllers\ProductController@quick_view');
Route::post('/load-comment', 'App\Http\Controllers\ProductController@load_comment');
Route::post('/send-comment', 'App\Http\Controllers\ProductController@send_comment');
//bai viet
Route::get('/danh-muc-bai-viet/{post_slug}', 'App\Http\Controllers\Post@danhmucbaiviet');
Route::get('/bai-viet/{post_slug}', 'App\Http\Controllers\Post@baiviet');
//order
Route::post('/update-order-qty', 'App\Http\Controllers\OrderController@update_order_qty');
Route::post('/update-qty', 'App\Http\Controllers\OrderController@update_qty');
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
//coupon
Route::get('/list-coupon','App\Http\Controllers\CouponController@list_coupon');
Route::get('/insert-coupon','App\Http\Controllers\CouponController@insert_coupon');
Route::post('/insert-coupon-code','App\Http\Controllers\CouponController@insert_coupon_code');
Route::post('/check-coupon','App\Http\Controllers\CouponController@check_coupon');
Route::get('/delete-coupon/{coupon_id}','App\Http\Controllers\CouponController@delete_coupon');
Route::get('/del-all-coupon', 'App\Http\Controllers\CouponController@del_all_coupon');
//delivery
Route::get('/delivery', 'App\Http\Controllers\DeliveryController@delivery');
Route::post('/select-delivery', 'App\Http\Controllers\DeliveryController@select_delivery');
Route::post('/select-delivery-home', 'App\Http\Controllers\DeliveryController@select_delivery_home');
Route::post('/insert-delivery', 'App\Http\Controllers\DeliveryController@insert_delivery');
Route::post('/update-delivery', 'App\Http\Controllers\DeliveryController@update_delivery');
Route::post('/select-feeship', 'App\Http\Controllers\DeliveryController@select_feeship');
Route::post('/calculator-fee', 'App\Http\Controllers\DeliveryController@calculator_fee');
Route::get('/del-fee', 'App\Http\Controllers\DeliveryController@del_fee');
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
Route::post('/update-cart', 'App\Http\Controllers\CartController@update_cart');
Route::get('/show-cart', 'App\Http\Controllers\CartController@show_cart');
Route::get('/gio-hang', 'App\Http\Controllers\CartController@gio_hang');
Route::get('/del-all-product', 'App\Http\Controllers\CartController@del_all_product');
Route::get('/delete-to-cart/{rowId}', 'App\Http\Controllers\CartController@delete_cart');
Route::get('/delete-sp/{session_id}', 'App\Http\Controllers\CartController@delete_sp');

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
Route::get('/manage-order', 'App\Http\Controllers\OrderController@manage_order');
Route::get('/view-order/{ordercode}', 'App\Http\Controllers\OrderController@view_order');
//Route::get('/manage-order', 'App\Http\Controllers\CheckoutController@manage_order');
//Route::get('/view-order/{orderId}', 'App\Http\Controllers\CheckoutController@view_order');
Route::get('/delete-order/{orderId}', 'App\Http\Controllers\CheckoutController@delete_order');
//checkout
Route::post('/confirm-order', 'App\Http\Controllers\DeliveryController@confirm_order');
//banner
Route::get('/manage-slider', 'App\Http\Controllers\SliderController@manage_banner');
Route::get('/add-slider', 'App\Http\Controllers\SliderController@add_banner');
Route::get('/active-slider/{sliderid}', 'App\Http\Controllers\SliderController@active_banner');
Route::get('/unactive-slider/{sliderid}', 'App\Http\Controllers\SliderController@unactive_banner');
Route::post('/save-slider', 'App\Http\Controllers\SliderController@save_banner');
//import and export data
Route::post('/import-csv', 'App\Http\Controllers\CategoryProduct@import_csv');
Route::post('/export-csv', 'App\Http\Controllers\CategoryProduct@export_csv');
//Authe register
Route::get('/register-auth', 'App\Http\Controllers\AuthController@register_auth');
Route::post('/register', 'App\Http\Controllers\AuthController@register');
//cate_post
Route::get('/add-cate-post', 'App\Http\Controllers\CategoryPost@add_cate_post');
Route::get('/all-cate-post', 'App\Http\Controllers\CategoryPost@all_cate_post');
Route::get('/edit-category-post/{cate_post_id}', 'App\Http\Controllers\CategoryPost@edit_category_post');
Route::post('/save-cate-post', 'App\Http\Controllers\CategoryPost@save_cate_post');
Route::get('/delete-category-post/{cate_post_id}', 'App\Http\Controllers\CategoryPost@delete_cate_post');
Route::post('/update-cate_post/{cate_post_id}', 'App\Http\Controllers\CategoryPost@update_cate_post');
Route::post('/danh-muc-bai-viet/{cate_post_slug}', 'App\Http\Controllers\CategoryPost@danh_muc_bai_viet');
//post
Route::get('/add-post', 'App\Http\Controllers\Post@add_post');
Route::post('/save-post', 'App\Http\Controllers\Post@save_post');
Route::get('/all-post', 'App\Http\Controllers\Post@all_post');
Route::get('/delete-post/{post_id}', 'App\Http\Controllers\Post@delete_post');
//gallery
Route::get('/add-gallery/{product_id}', 'App\Http\Controllers\GalleryController@add_gallery');
Route::post('/select-gallery', 'App\Http\Controllers\GalleryController@select_gallery');
Route::post('/insert-gallery/{pro_id}', 'App\Http\Controllers\GalleryController@insert_gallery');
Route::post('/update-gallery-name', 'App\Http\Controllers\GalleryController@update_gallery_name');
Route::post('/update-gallery', 'App\Http\Controllers\GalleryController@update_gallery');
Route::post('/delete-gallery', 'App\Http\Controllers\GalleryController@delete_gallery');
