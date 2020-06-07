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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::group(['prefix' => 'brand'], function () {
    Route::get('/', 'BrandController@index')->name('brand.index');
    Route::get('create', 'BrandController@create')->name('brand.create');
    Route::post('store', 'BrandController@store')->name('brand.store');
    Route::get('edit/{id}', 'BrandController@edit')->name('brand.edit');
    Route::put('update/{id}', 'BrandController@update')->name('brand.update');
    Route::delete('delete/{id}', 'BrandController@delete')->name('brand.delete');

    Route::get('by-category', 'BrandController@brandByCategory')->name('brand.by-category');
});

Route::group(['prefix' => 'product'], function () {
    Route::get('/', 'ProductController@index')->name('product.index');
    Route::get('create', 'ProductController@create')->name('product.create');
    Route::post('store', 'ProductController@store')->name('product.store');
    Route::get('edit/{id}', 'ProductController@edit')->name('product.edit');
    Route::put('update/{id}', 'ProductController@update')->name('product.update');
    Route::delete('delete/{id}', 'ProductController@delete')->name('product.delete');

    Route::group(['prefix' => 'version'], function () {
        Route::post('store', 'ProductController@versionStore')->name('version.store');
    });
});

Route::group(['prefix' => 'feature'], function () {
    Route::get('/', 'FeatureController@index')->name('feature.index');
    Route::get('create', 'FeatureController@create')->name('feature.create');
    Route::post('store', 'FeatureController@store')->name('feature.store');
    Route::get('edit/{id}', 'FeatureController@edit')->name('feature.edit');
    Route::put('update/{id}', 'FeatureController@update')->name('feature.update');
    Route::delete('delete/{id}', 'FeatureController@delete')->name('feature.delete');
});



