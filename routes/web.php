<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ItemController;
use App\Http\Controllers\SellerController; 
use App\Http\Controllers\BankAccountController;
use App\Http\Controllers\ShippingController;
use App\Http\Controllers\CityController;
use App\Http\Controllers\SliderController;
use App\Http\Controllers\UnitController;
use App\Http\Controllers\StatusOrderController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\ShopPaymentController;
use App\Http\Controllers\AdminFeesController;

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
    return redirect()->route('login');
});

// Auth::routes();
Auth::routes(['verify'=>true]);

Route::group(['middleware' => ['auth','verified']], function () {
    // Route::group(['middleware' => ['auth']], function () {
    Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
    Route::get('/home-seller', [App\Http\Controllers\HomeController::class, 'indexSeller'])->name('homeSeller');

    Route::view('template', 'layouts.beranda');

    Route::resource('users', UserController::class);
    Route::resource('category', CategoryController::class);
    Route::resource('customer', CustomerController::class);
    Route::resource('product', ProductController::class);
    Route::resource('item', ItemController::class);
    Route::resource('seller', SellerController::class);
    Route::resource('bank_account', BankAccountController::class);
    Route::resource('shipping', ShippingController::class);
    Route::resource('kota', CityController::class);
    Route::resource('slider', SliderController::class);
    Route::resource('unit', UnitController::class);
    Route::resource('statusOrder', StatusOrderController::class);
    Route::resource('city', CityController::class);
    Route::resource('order', OrderController::class);
    Route::resource('admin_fee', AdminFeesController::class);
    Route::resource('shop_payment', ShopPaymentController::class);
    Route::get('pesanan-masuk-admin', [App\Http\Controllers\OrderController::class, 'indexMenungguKonfirmasi'])->name('pesananMasukAdmin');
    Route::get('pesanan-masuk', [App\Http\Controllers\OrderController::class, 'indexMasuk'])->name('pesananMasuk');
    Route::get('pesanan-dikirim', [App\Http\Controllers\OrderController::class, 'indexDikirim'])->name('pesananDikirim');
    Route::get('edit-pesanan-dikirim/{id}', [App\Http\Controllers\OrderController::class, 'updateDikirim'])->name('updateDikirim');
    Route::get('pesanan-diterima', [App\Http\Controllers\OrderController::class, 'indexDiterima'])->name('pesananDiterima');
    Route::get('pesanan-dibatalkan', [App\Http\Controllers\OrderController::class, 'indexDibatalkan'])->name('pesananDibatalkan');
    Route::get('admin/pesanan-dibatalkan', [App\Http\Controllers\OrderController::class, 'indexDibatalkanAdmin'])->name('pesananDibatalkanAdmin');
    Route::get('show-masuk-admin/{id}', [App\Http\Controllers\OrderController::class, 'showMenungguKonfirmasi'])->name('show-masuk-admin');
    Route::get('show-masuk/{id}', [App\Http\Controllers\OrderController::class, 'showMasuk'])->name('showMasuk');
    Route::get('show-dikirim/{id}', [App\Http\Controllers\OrderController::class, 'showDikirim'])->name('showDikirim');
    Route::get('show-diterima/{id}', [App\Http\Controllers\OrderController::class, 'showDiterima'])->name('showDiterima');
    Route::get('show-dibatalkan/{id}', [App\Http\Controllers\OrderController::class, 'showDibatalkan'])->name('showDibatalkan');
    Route::get('admin/show-dibatalkan/{id}', [App\Http\Controllers\OrderController::class, 'showDibatalkanAdmin'])->name('showDibatalkanAdmin');
    Route::get('edit-status/{id}', [App\Http\Controllers\OrderController::class, 'create'])->name('create');
    Route::put('update/{id}', [App\Http\Controllers\OrderController::class, 'updatePenjual'])->name('updatePenjual');
    Route::get('edit-penjual/{id}', [App\Http\Controllers\OrderController::class, 'editPenjual'])->name('editPenjual');
    Route::get('shop-payment/cetak-pdf', [App\Http\Controllers\ShopPaymentController::class, 'cetakPDF'])->name('cetakPDF');
    Route::get('shop-payment/index-penjual', [App\Http\Controllers\ShopPaymentController::class, 'indexPenjual'])->name('indexPenjual');
    Route::get('biaya-admin', [App\Http\Controllers\AdminFeesController::class, 'index'])->name('indexBiayaAdmin');
    Route::get('shop-payment/cetak-pdf-penjual', [App\Http\Controllers\ShopPaymentController::class, 'cetakPdfPenjual'])->name('cetakPdfPenjual');
});
