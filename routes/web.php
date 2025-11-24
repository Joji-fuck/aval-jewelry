<?php

use Illuminate\Support\Facades\Route;

//главная
Route::get('/', function () {
    $title = 'Ювелирная мастерская Аваль';
    return view('home', compact('title'));
}) -> name('home');

//Каталог
Route::resource('catalog', 'App\Http\Controllers\CatalogController')->names('catalog');

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
Route::get('/profile/password/update', [\App\Http\Controllers\ProfileController::class, 'passwordResetUpdate']) -> name('profile.password.update');
Route::get('/profile/history', [\App\Http\Controllers\ProfileController::class, 'history']) -> name('profile.history');

//Каталог
//Route::get('/catalog', [\App\Http\Controllers\CatalogController::class, 'index']) -> name('catalog');
//Route::post('/catalog/store', [\App\Http\Controllers\CatalogController::class, 'store']) -> name('catalog.store');
//Route::get('/catalog/cart', [\App\Http\Controllers\CatalogController::class, 'cart']) -> name('catalog.cart');
//
////auth-crm
//Route::get('/login', [\App\Http\Controllers\AuthController::class, 'login_index']) -> name('login.index');
//Route::post('/login', [\App\Http\Controllers\AuthController::class, 'login']) -> name('login');
//Route::get('/register', [\App\Http\Controllers\AuthController::class, 'register_index']) -> name('register.index');
//Route::post('/register', [\App\Http\Controllers\AuthController::class, 'register']) -> name('register');

//CRM
//Route::prefix('/crm')->group(function () {
//    //Домашний роут
//    Route::get('/', [\App\Http\Controllers\CrmController::class, 'index']) -> name('CRM.index');
//
//    //CRM-orders
//    Route::prefix('/orders')->group(function () {
//        Route::get('/', [\App\Http\Controllers\CrmController::class, 'orders']) -> name('CRM.orders');
//    });
//
//    //CRM-catalog
//    Route::prefix('/catalog')->group(function () {
//        Route::get('/', [\App\Http\Controllers\CrmController::class, 'catalog']) -> name('CRM.catalog');
//        Route::resources([
//            'products' => \App\Http\Controllers\Crm\Catalog\ProductController::class,
//            'categories' => \App\Http\Controllers\Crm\Catalog\CategoryController::class,
//            'materials' => \App\Http\Controllers\Crm\Catalog\MaterialController::class,
//            'sizes' => \App\Http\Controllers\Crm\Catalog\SizeController::class,
//        ]);
//    });
//
//
//    //CRM-employed
//    Route::prefix('/employed')->group(function () {
//        Route::get('/', [\App\Http\Controllers\CrmController::class, 'employed']) -> name('CRM.employed');
//    });
//});

