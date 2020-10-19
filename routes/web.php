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
// Frontend
Route::get('/','HomeController@index');
Route::get('/trang-chu', 'HomeController@index');
Route::post('/search', 'HomeController@search');

//Dah mục sản phẩm trang chủ
Route::get('/danh-muc-san-pham/{category_id}', 'CategoryProduct@show_category_home');
//Thương hiệu sản phẩm trang chủ
Route::get('/thuong-hieu-san-pham/{brand_id}', 'BrandProduct@show_brand_home');
//Chi tiết sản phẩm trang chủ
Route::get('/chi-tiet-san-pham/{product_id}', 'ProductController@detail_product');

// Backend
Route::get('admin', 'AdminController@index');
Route::get('dashboard', 'AdminController@show_dashboard');
Route::get('/logout', 'AdminController@log_out');
Route::post('admin-dashboard', 'AdminController@dashboard');

// Category product 
Route::get('add-category-product', 'CategoryProduct@add_category_product');
Route::get('all-category-product', 'CategoryProduct@all_category_product');
Route::get('/unactive-category-product/{category_product_id}','CategoryProduct@unactive_category_product');
Route::get('/active-category-product/{category_product_id}','CategoryProduct@active_category_product');
Route::get('/edit-category-product/{category_product_id}', 'CategoryProduct@edit_category_product');
Route::get('/delete-category-product/{category_product_id}', 'CategoryProduct@delete_category_product');
Route::post('save-category-product', 'CategoryProduct@save_category_product');
Route::post('update-category-product/{category_product_id}', 'CategoryProduct@update_category_product');


// Brand product

Route::get('add-brand-product', 'BrandProduct@add_brand_product');
Route::get('all-brand-product', 'BrandProduct@all_brand_product');
Route::get('/unactive-brand-product/{brand_product_id}','BrandProduct@unactive_brand_product');
Route::get('/active-brand-product/{brand_product_id}','BrandProduct@active_brand_product');
Route::get('/edit-brand-product/{brand_product_id}', 'BrandProduct@edit_brand_product');
Route::get('/delete-brand-product/{brand_product_id}', 'BrandProduct@delete_brand_product');
Route::post('save-brand-product', 'BrandProduct@save_brand_product');
Route::post('update-brand-product/{brand_product_id}', 'BrandProduct@update_brand_product');

// Product

Route::get('add-product', 'ProductController@add_product');
Route::get('all-product', 'ProductController@all_product');
Route::get('/unactive-product/{product_id}','ProductController@unactive_product');
Route::get('/active-product/{product_id}','ProductController@active_product');
Route::get('/edit-product/{product_id}', 'ProductController@edit_product');
Route::get('/delete-product/{product_id}', 'ProductController@delete_product');
Route::post('save-product', 'ProductController@save_product');
Route::post('update-product/{product_id}', 'ProductController@update_product');

// Feature
Route::get('add-feature', 'FeatureController@add_feature');
Route::get('all-feature', 'FeatureController@all_feature');
Route::get('/unactive-feature/{feature_id}','FeatureController@unactive_feature');
Route::get('/active-feature/{feature_id}','FeatureController@active_feature');
Route::get('/edit-feature/{feature_id}', 'FeatureController@edit_feature');
Route::get('/delete-feature/{feature_id}', 'FeatureController@delete_feature');
Route::post('save-feature', 'FeatureController@save_feature');
Route::post('update-feature/{feature_id}', 'FeatureController@update_feature');

// Product_Feature
Route::get('add-product-feature', 'ProductFeatureController@add_product_feature');
Route::get('all-product-feature', 'ProductFeatureController@all_product_feature');
Route::get('/unactive-product-feature/{product_feature_id}','ProductFeatureController@unactive_product_feature');
Route::get('/active-product-feature/{product_feature_id}','ProductFeatureController@active_product_feature');
Route::get('/edit-product-feature/{product_feature_id}', 'ProductFeatureController@edit_product_feature');
Route::get('/delete-product-feature/{feature_id}', 'ProductFeatureController@delete_product_feature');
Route::post('save-product-feature', 'ProductFeatureController@save_product_feature');
Route::post('update-product-feature/{product_feature_id}', 'ProductFeatureController@update_product_feature');

// Cart 
Route::post('save-cart', 'CartController@save_cart');
Route::get('show-cart', 'CartController@show_cart');
Route::get('/delete-cart/{rowId}', 'CartController@delete_cart');
Route::get('/increase-cart/{rowId}', 'CartController@increase_cart');
Route::get('/reduce-cart/{rowId}', 'CartController@reduce_cart');
Route::post('/update-cart', 'CartController@update_cart');

// Check out
Route::get('/login-checkout', 'CheckoutController@login_checkout');
Route::post('/add-customer', 'CheckoutController@add_customer');
Route::get('/checkout', 'CheckoutController@checkout');
Route::post('/save-checkout-customer', 'CheckoutController@save_checkout_customer');
Route::get('/logout-checkout', 'CheckoutController@logout_checkout');
Route::post('/login-customer', 'CheckoutController@login_customer');



// other
Route::get('printer', 'HomeController@printer');
Route::get('iframe_printer', 'HomeController@iframe_printer');
Route::get('login_injection', 'HomeController@login_injection');

