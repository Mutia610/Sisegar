<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\CustomerController;
use App\Http\Controllers\Api\CategoryController;
use App\Http\Controllers\Api\ProductController;
use App\Http\Controllers\Api\SliderController;
use App\Http\Controllers\Api\CartController;
use App\Http\Controllers\Api\CityController;
use App\Http\Controllers\Api\ShippingController;
use App\Http\Controllers\Api\OrderController;
use App\Http\Controllers\Api\BankAccountController;
use App\Http\Controllers\Api\PaymentConfirmationController;
use App\Http\Controllers\Api\CourierController;
use App\Http\Controllers\Api\UserController;
use App\Http\Controllers\Api\AdminFeeController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('login', [CustomerController::class, 'login']);
Route::post('register', [CustomerController::class, 'register']);
Route::get('get-customer', [CustomerController::class, 'getCustomer']);
Route::get('email', [CustomerController::class, 'getEmail']);
Route::post('ubah-password', [CustomerController::class, 'ubahPassword']);
Route::post('update-customer', [CustomerController::class, 'updateCustomer']);
Route::post('update-profile', [CustomerController::class, 'updateProfile']);
Route::post('update-foto-profile', [CustomerController::class, 'updateFotoProfile']); 
Route::get('category', [CategoryController::class, 'getAll']);
// Route::get('home', [ProductController::class, 'popularAndLatest']);
Route::get('product', [ProductController::class, 'getAll']);
Route::get('popular', [ProductController::class, 'popular']);
Route::get('latest', [ProductController::class, 'latest']);
Route::get('product-by-category', [ProductController::class, 'getByCategory']);
Route::get('product-by-user', [ProductController::class, 'getByUser']);
Route::get('slider', [SliderController::class, 'slider']);
Route::post('insert-keranjang', [CartController::class, 'insertKeranjang']);
Route::get('get-keranjang', [CartController::class, 'getKeranjang']);
Route::get('get-keranjang-recycler', [CartController::class, 'getKeranjangRecycler']);
Route::get('get-jumlah-keranjang', [CartController::class, 'getJmlKeranjang']);
Route::post('update-keranjang', [CartController::class, 'updateKeranjang']);
Route::post('delete-keranjang', [CartController::class, 'deleteKeranjang']);
Route::get('city', [CityController::class, 'getCity']);
Route::get('name-city', [CityController::class, 'getCityName']);
Route::get('ongkir', [ShippingController::class, 'getOngkir']);
Route::post('insert-order', [OrderController::class, 'insertOrder']);
Route::get('get-order', [OrderController::class, 'getByStatusOrder']);
Route::get('get-detail-order', [OrderController::class, 'getByStatusDetail']);
Route::post('update-order', [OrderController::class, 'updateStatusOrder']);
Route::get('get-rekening', [BankAccountController::class, 'getByIdUser']);
Route::post('insert-confirmation', [PaymentConfirmationController::class, 'insertConfirmation']);
Route::get('courier', [CourierController::class, 'getCourier']);
Route::get('ongkir-courier', [CourierController::class, 'getAllCourier']);
Route::post('inup-courier', [CourierController::class, 'inUpCourier']);
Route::post('delete-courier', [CourierController::class, 'deleteCourier']);
Route::get('user', [UserController::class, 'getByIdUser']);
Route::get('presentase', [AdminFeeController::class, 'getPresentase']);

