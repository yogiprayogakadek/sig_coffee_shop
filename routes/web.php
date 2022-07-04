<?php

use Illuminate\Support\Facades\Route;


Route::get('/', 'Main\DashboardController@index')->name('main')->middleware('auth');
Route::prefix('/')->namespace('Main')->middleware('auth')->group(function(){
    Route::prefix('/dashboard')->name('dashboard.')->group(function(){
        Route::get('/', 'DashboardController@index')->name('index');
        // Route::post('/chart', 'DashboardController@chart')->name('chart');
    });

});
Route::prefix('/admin')->namespace('Admin')->name('admin.')->middleware('auth')->group(function(){
    Route::prefix('/owner')->group(function(){
        Route::get('/', 'OwnerController@index')->name('owner.index');
        Route::get('/render', 'OwnerController@render')->name('owner.render');
        Route::get('/print', 'OwnerController@print')->name('owner.print');
        Route::get('/detail/{id}', 'OwnerController@detail')->name('owner.detail');
        Route::get('/delete/{id}', 'OwnerController@delete')->name('owner.delete');
    });
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

