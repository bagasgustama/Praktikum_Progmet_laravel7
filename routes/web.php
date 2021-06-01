<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\CourierController;
use App\Http\Controllers\ProductsController;
use App\Http\Controllers\TransactionsController;
use App\Http\Controllers\DetailTransactionsController;

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

Route::get('/addpic', 'HomeController@pic');
Route::post('/addpic/upload', 'HomeController@uploadpic');
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


    Route::get('/admin/home', [AdminController::class, 'index'])->name('admin.home');
	Route::get('/daftar/diskon', [ProductsController::class, 'listdiskon'])->name('listdiskon');
	Route::post('/save/diskon', [ProductsController::class, 'savediskon'])->name('savediskon');
	Route::get('/daftar/review', [ProductsController::class, 'listreview'])->name('listreview');
	Route::get('/hapus/review', [ProductsController::class, 'hapusreview'])->name('admin.hapus.review');
	Route::post('/post/foto/product', [ProductsController::class, 'saveproductimage'])->name('post.fotoproduk');
	Route::get('/list/products', [ProductsController::class , 'index'])->name('list.products');
	Route::post('/save/product', [ProductsController::class, 'saveproduct'])->name('save.product');
	Route::get('/ubah/product/page', [ProductsController::class, 'ubahproductpage'])->name('ubah.product.page');
	Route::post('/ubah/product', [ProductsController::class, 'ubahproduct'])->name('ubah.product');
	Route::get('/hapus/product', [ProductsController::class, 'hapusproduct'])->name('hapus.product');
	Route::get('/list/courier', [CourierController::class , 'index'])->name('list.courier');
	Route::post('/save/courier', [CourierController::class, 'savecou'])->name('save.courier');
	Route::post('/ubah/courier', [CourierController::class, 'ubahcou'])->name('ubah.courier');
	Route::get('/hapus/courier', [CourierController::class, 'hapuscou'])->name('hapus.courier');
	Route::get('/list/category', [CategoryController::class , 'index'])->name('list.category');
	Route::post('/save/category', [CategoryController::class, 'savecategory'])->name('save.category');
	Route::post('/ubah/category', [CategoryController::class, 'ubahcategory'])->name('ubah.category');
	Route::get('/hapus/category', [CategoryController::class, 'hapuscategory'])->name('hapus.category');
    Route::get('/admin/logout', [AuthController::class, 'logout'])->name('admin.logout');
	// Route::get('/list/transaction', [TransactionsController::class , 'index'])->name('list.transaction');
    // Route::post('/save/transaction', [TransactionsController::class, 'savetransaction'])->name('save.transaction');
    
    Route::get('/list/transaction', [TransactionsController::class , 'index'])->name('list.transaction');
    Route::get('/list/detail_transaction', [DetailTransactionsController::class , 'index'])->name('list.detailtrx');
    Route::post('/save/transaction', [TransactionsController::class, 'ubahstatus'])->name('save.transaction');
    Route::get('/ubah/transaction/page', [TransactionsController::class, 'ubahtransactionpage'])->name('ubah.transaction.page');
    
});