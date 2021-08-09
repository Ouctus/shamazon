<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Backend\IndexController;
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
    return redirect()->route('seller.dashboard');
}); 

Route::get('/login', function () {
    return redirect()->route('login');
});

Route::namespace('Backend')->group(function () {

    Route::get('login','LoginController@showLoginForm')->name('login');
    Route::post('login','LoginController@sellerLogin')->name('vendor.login');
    Route::get('register','RegisterController@register')->name('vendor.register');
    Route::post('register','RegisterController@registerStore')->name('vendor.register.store');

    Route::group(['middleware' => 'auth:seller'], function () {
        Route::get('dashboard',             [IndexController::class, 'index'])->name('seller.dashboard');
        Route::get('product/list',          [IndexController::class, 'list'])->name('seller.product.list');
        Route::get('product/create',        [IndexController::class, 'create'])->name('seller.product.create');
        Route::post('product/create',       [IndexController::class, 'store'])->name('seller.product.store');
        Route::get('product/edit/{slug}',   [IndexController::class, 'edit'])->name('seller.product.edit');
        Route::post('product/edit/{slug}',  [IndexController::class, 'update'])->name('seller.product.update');
    });

    Route::post('logout','LoginController@logout')->name('vendor.logout');
});

