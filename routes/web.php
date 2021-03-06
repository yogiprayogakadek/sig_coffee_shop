<?php

use Illuminate\Support\Facades\Route;



Route::prefix('/')->namespace('Main')->group(function(){
    Route::get('/', 'MainController@index')->name('main');

    // single page
    Route::get('/detail/{id}', 'MainController@detail')->name('detail');
    Route::post('/ulasan', 'MainController@ulasan')->name('ulasan');

    // search
    Route::prefix('/search')->name('search.')->group(function(){
        Route::get('/', 'MainController@search')->name('index');
        Route::get('/keyword/{keyword}', 'MainController@searchKeyword')->name('keyword');
    });

    // Register
    Route::post('/', 'MainController@register')->name('main.register');

    Route::middleware('auth')->group(function() {
        Route::prefix('/dashboard')->name('dashboard.')->group(function(){
            Route::get('/', 'DashboardController@index')->name('index');
            // Route::post('/chart', 'DashboardController@chart')->name('chart');
        });
    });

});
Route::prefix('/admin')->namespace('Admin')->name('admin.')->middleware('auth')->group(function(){
    Route::prefix('/owner')->group(function(){
        Route::get('/', 'OwnerController@index')->name('owner.index');
        Route::get('/render', 'OwnerController@render')->name('owner.render');
        Route::get('/print', 'OwnerController@print')->name('owner.print');
        Route::get('/detail/{id}', 'OwnerController@detail')->name('owner.detail');
        Route::get('/delete/{id}', 'OwnerController@delete')->name('owner.delete');
        Route::post('/change-status', 'OwnerController@changeStatus')->name('owner.change-status');
    });
});

Route::prefix('/owner')->namespace('Owner')->name('owner.')->middleware('auth')->group(function(){
    Route::prefix('/kedai')->name('kedai.')->group(function(){
        Route::get('/', 'KedaiController@index')->name('index');
        Route::get('/create', 'KedaiController@create')->name('create');
        Route::get('/render', 'KedaiController@render')->name('render');
        Route::post('/store', 'KedaiController@store')->name('store');
        Route::post('/upload', 'KedaiController@upload')->name('upload');
        Route::get('/edit/{id}', 'KedaiController@edit')->name('edit');
        Route::post('/update', 'KedaiController@update')->name('update');
        Route::get('/delete/{id_kedai}', 'KedaiController@delete')->name('delete');
        Route::get('/print', 'KedaiController@print')->name('print');
        Route::post('/change-status', 'KedaiController@changeStatus')->name('change-status');
        
        // suasana kedai
        Route::get('/detail/{id}', 'KedaiController@detail')->name('detail');
        Route::get('/delete-image/{id_kedai}/{id_foto}', 'KedaiController@deleteImage')->name('delete-image');
    });

    Route::prefix('/produk')->name('produk.')->group(function(){
        Route::get('/', 'ProdukController@index')->name('index');
        Route::get('/create', 'ProdukController@create')->name('create');
        Route::get('/render', 'ProdukController@render')->name('render');
        Route::post('/store', 'ProdukController@store')->name('store');
        Route::get('/edit/{id}', 'ProdukController@edit')->name('edit');
        Route::get('/detail/{id}', 'ProdukController@detail')->name('detail');
        Route::post('/update', 'ProdukController@update')->name('update');
        Route::get('/print', 'ProdukController@print')->name('print');
        Route::get('/delete/{id}', 'ProdukController@delete')->name('delete');
        Route::post('/change-status', 'ProdukController@changeStatus')->name('change-status');
    });

    Route::prefix('/promo')->name('promo.')->group(function(){
        Route::get('/', 'PromoController@index')->name('index');
        Route::get('/create', 'PromoController@create')->name('create');
        Route::get('/render', 'PromoController@render')->name('render');
        Route::post('/store', 'PromoController@store')->name('store');
        Route::get('/edit/{id}', 'PromoController@edit')->name('edit');
        Route::post('/update', 'PromoController@update')->name('update');
        Route::get('/print', 'PromoController@print')->name('print');
        Route::get('/delete/{id}', 'PromoController@delete')->name('delete');
        Route::post('/change-status', 'PromoController@changeStatus')->name('change-status');
    });

    Route::prefix('/ulasan')->name('ulasan.')->group(function(){
        Route::get('/', 'UlasanController@index')->name('index');
        Route::get('/render', 'UlasanController@render')->name('render');
        Route::get('/filter/{id_kedai}', 'UlasanController@filter')->name('filter');
        Route::post('/change-status', 'UlasanController@changeStatus')->name('change-status');
    });
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

