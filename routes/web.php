<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('home', ['title' => 'Ювелирная мастерская Аваль']);
}) -> name('home');

Route::get('/catalog', function () {
    return view('home', ['title' => 'Ювелирная мастерская Аваль']);
}) -> name('catalog');

Route::get('/login', function () {
    return view('home', ['title' => 'Ювелирная мастерская Аваль']);
}) -> name('login');

Route::get('/register', function () {
    return view('home', ['title' => 'Ювелирная мастерская Аваль']);
}) -> name('register');


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

