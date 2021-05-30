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

Route::get('/', 'WelcomeController@index');

//verify email
Auth::routes(['verify' => true]);

Route::get('/home', 'HomeController@index')->name('home');
Route::post('/user/logout', 'Auth\LoginController@userLogout')->name('user.logout');

Route::prefix('admin')->group(function () {
    // Dashboard route
    Route::get('/', 'AdminController@index')->name('admin.dashboard');

    // Login routes
    Route::get('/login', 'Auth\AdminLoginController@showLoginForm')->name('admin.login');
    Route::post('/login', 'Auth\AdminLoginController@login')->name('admin.login.submit');

    // Logout route
    Route::post('/logout', 'Auth\AdminLoginController@logout')->name('admin.logout');

    // Register routes
    Route::get('/register', 'Auth\AdminRegisterController@showRegistrationForm')->name('admin.register');
    Route::post('/register', 'Auth\AdminRegisterController@register')->name('admin.register.submit');

    // Password reset routes
    Route::get('/password/reset', 'Auth\AdminForgotPasswordController@showLinkRequestForm')->name('admin.password.request');
    Route::post('/password/email', 'Auth\AdminForgotPasswordController@sendResetLinkEmail')->name('admin.password.email');
    Route::get('/password/reset/{token}', 'Auth\AdminResetPasswordController@showResetForm')->name('admin.password.reset');
    Route::post('/password/reset', 'Auth\AdminResetPasswordController@reset')->name('admin.password.update');
});
Auth::routes();


Route::get('/home', 'HomeController@index')->name('home');
Route::get('/produk','MarketController@viewproduct');
Route::get('/produk/{produk:id}/view','MarketController@viewdetailproduct');
Route::get('/kategori/{product_categories:id}','MarketController@viewproductkategories');


Route::group(['middleware'=> ['auth']],function (){

    Route::get('/cart','CartController@cartproduk');
    Route::post('/cart/store','CartController@storecart');
    Route::delete('/produk/cart/{cart:id}/deletecart','CartController@hapuscart');
    Route::post('/produk/addqty/{id}','CartController@addqty');
    Route::post('/produk/minusqty/{id}','CartController@minusqty');

    Route::get('/checkout','CheckoutController@checkoutproduk');
    Route::post('/checkout-produk','CheckoutController@storecheckout');
    Route::post('/produk/cekongkir','CheckoutController@cekongkir');
    Route::get('/upload-bukti/{id}','CheckoutController@confirmproduct');
    Route::post('uploadpembayaran/{id}','CheckoutController@uploadpayment');
    Route::get('sukses-bayar/{id}','CheckoutController@successpayment');
    Route::post('/produk/cancel/{id}','CheckoutController@cancelproduct');
    Route::get('/statuspemesanan/{id}','CheckoutController@confirmproduct');

    Route::get('/produk/buynow','BuyNowController@buynow');
    Route::post('/produk/store/buynow','BuyNowController@storebuynow');

    Route::get('/profile', 'MarketController@viewprofile')->name('profile');
    Route::get('/edit_profile/{id}','MarketController@editfotoprofile');
    Route::post('/profile/uploadfoto/{id}','MarketController@uploadfotoprofile');
    Route::get('/transaksi', 'MarketController@tampiltransaksi');
    Route::post('/review','MarketController@tambahreview');

});


Route::group(['middleware'=> ['auth:admin']],function () {


});
