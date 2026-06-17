<?php

use App\Http\Controllers\AdminController;
use Illuminate\Support\Facades\Route;

//главная
Route::get('/', function () {
    $title = 'Ювелирная мастерская Аваль';
    return view('home', compact('title'));
}) -> name('home');

// Корзина
Route::get('/cart', [\App\Http\Controllers\CartController::class, 'index'])->name('cart.index');
Route::get('/cart/add/{id}', [\App\Http\Controllers\CatalogController::class, 'add'])->name('cart.add');
Route::get('/cart/remove/{id}', [\App\Http\Controllers\CartController::class, 'remove'])->name('cart.remove');
Route::post('/order', [\App\Http\Controllers\CRM\OrderController::class, 'store'])->name('order.store');

//Каталог
//Route::resource('catalog', 'App\Http\Controllers\CatalogController')->names('catalog');
Route::get('/catalog', [\App\Http\Controllers\CatalogController::class, 'index']) -> name('catalog.index');
Route::get('/catalog/{slug}', [\App\Http\Controllers\CatalogController::class, 'show']) -> name('catalog.show');

//Вход + Регистрация
Route::prefix('auth')->group(function(){
    Route::get('/login', [\App\Http\Controllers\AuthController::class, 'loginIndex']) -> name('login.index');
    Route::post('/login/store', [\App\Http\Controllers\AuthController::class, 'loginStore']) -> name('login.store');

    Route::get('/register', [\App\Http\Controllers\AuthController::class, 'registerIndex']) -> name('register.index');
    Route::post('/register/store', [\App\Http\Controllers\AuthController::class, 'registerStore']) -> name('register.store');

    Route::get('/logout', [\App\Http\Controllers\AuthController::class, 'logout']) -> name('logout');
});

//Профиль
Route::get('/profile', [\App\Http\Controllers\ProfileController::class, 'index']) -> name('profile.index');
Route::patch('/profile/update', [\App\Http\Controllers\ProfileController::class, 'indexUpdate']) -> name('profile.index.update');
Route::get('/profile/address', [\App\Http\Controllers\ProfileController::class, 'address']) -> name('profile.address');
Route::patch('/profile/address/update', [\App\Http\Controllers\ProfileController::class, 'addressUpdate']) -> name('profile.address.update');
Route::get('/profile/password', [\App\Http\Controllers\ProfileController::class, 'passwordReset']) -> name('profile.password');
Route::patch('/profile/password/update', [\App\Http\Controllers\ProfileController::class, 'passwordResetUpdate']) -> name('profile.password.update');
Route::get('/profile/history', [\App\Http\Controllers\ProfileController::class, 'history']) -> name('profile.history');


Route::get('/about', [\App\Http\Controllers\AboutController::class, 'index']) -> name('about.index');

Route::middleware(['auth', 'admin'])->prefix('/crm')->name('crm.')->group(function(){
    Route::get('/', [AdminController::class, 'index']) -> name('index');

    Route::resource('catalog-product', \App\Http\Controllers\CRM\CatalogProductController::class)->names('catalog-product');

    Route::get('/catalog-stone', [\App\Http\Controllers\CRM\CatalogStoneController::class, 'index']) -> name('catalog-stone.index');
    Route::get('/order', [\App\Http\Controllers\CRM\OrderController::class, 'index']) -> name('order.index');
    Route::post('/orders/{order}/status', [\App\Http\Controllers\CRM\OrderController::class, 'updateStatus']) -> name('order.updateStatus');
    Route::get('/parameter', [\App\Http\Controllers\CRM\ParameterController::class, 'index']) -> name('parameter.index');

    Route::prefix('/parameter/{type}')->name('parameter.')->group(function(){
        Route::get('/', [\App\Http\Controllers\CRM\ParameterController::class, 'index']) -> name('index');
        Route::post('/store', [\App\Http\Controllers\CRM\ParameterController::class, 'store']) -> name('store');
        Route::get('/{id}/edit', [\App\Http\Controllers\CRM\ParameterController::class, 'edit']) -> name('edit');
        Route::put('/{id}', [\App\Http\Controllers\CRM\ParameterController::class, 'update']) -> name('update');
        Route::delete('/{id}', [\App\Http\Controllers\CRM\ParameterController::class, 'destroy']) -> name('destroy');
    });

    Route::get('/ring-orders', [\App\Http\Controllers\CRM\RingOrderAdminController::class, 'index'])->name('ring-orders.index');
    Route::get('/ring-orders/{ringOrder}', [\App\Http\Controllers\CRM\RingOrderAdminController::class, 'show'])->name('ring-orders.show');
    Route::patch('/ring-orders/{ringOrder}/status', [\App\Http\Controllers\CRM\RingOrderAdminController::class, 'updateStatus'])->name('ring-orders.update-status');
});


Route::get('/constructor', [\App\Http\Controllers\RingConstructorController::class, 'index'])->name('constructor.index');
Route::get ('/constructor/checkout',[\App\Http\Controllers\RingOrderController::class, 'create'])->name('ring-orders.create');
Route::post('/constructor/checkout',[\App\Http\Controllers\RingOrderController::class, 'store'])->name('ring-orders.store');
Route::get ('/constructor/success/{ringOrder}', [\App\Http\Controllers\RingOrderController::class, 'success'])->name('ring-orders.success');





