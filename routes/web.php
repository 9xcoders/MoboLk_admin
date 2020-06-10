<?php

use Illuminate\Support\Facades\Auth;
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

Auth::routes();

Route::get('/', 'HomeController@index')->name('home');

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
    Route::put('update/{id}', 'ProductController@update')->name('product.update');
    Route::delete('delete/{id}', 'ProductController@delete')->name('product.delete');
    Route::delete('delete-img/{id}', 'ProductController@deleteProductImage')->name('product.deleteImage');

    Route::group(['prefix' => 'edit'], function () {
        Route::group(['prefix' => '{id}'], function () {
            Route::get('/', 'ProductController@edit')->name('product.edit');
            Route::group(['prefix' => 'version'], function () {
                Route::get('create', 'ProductController@versionCreate')->name('version.create');
                Route::post('store', 'ProductController@versionStore')->name('version.store');
                Route::get('edit/{versionId}', 'ProductController@versionEdit')->name('version.edit');
                Route::put('update/{versionId}', 'ProductController@versionUpdate')->name('version.update');
                Route::delete('delete/{versionId}', 'ProductController@versionDelete')->name('version.delete');
            });
        });


    });
    Route::get('search', 'ProductController@search')->name('product.search');

});

Route::group(['prefix' => 'feature'], function () {
    Route::get('/', 'FeatureController@index')->name('feature.index');
    Route::get('create', 'FeatureController@create')->name('feature.create');
    Route::post('store', 'FeatureController@store')->name('feature.store');
    Route::get('edit/{id}', 'FeatureController@edit')->name('feature.edit');
    Route::put('update/{id}', 'FeatureController@update')->name('feature.update');
    Route::delete('delete/{id}', 'FeatureController@delete')->name('feature.delete');
});

Route::group(['prefix' => 'feature-category'], function () {
    Route::get('/', 'FeatureCategoryController@index')->name('feature-category.index');
    Route::get('create', 'FeatureCategoryController@create')->name('feature-category.create');
    Route::post('store', 'FeatureCategoryController@store')->name('feature-category.store');
    Route::get('edit/{id}', 'FeatureCategoryController@edit')->name('feature-category.edit');
    Route::put('update/{id}', 'FeatureCategoryController@update')->name('feature-category.update');
    Route::delete('delete/{id}', 'FeatureCategoryController@delete')->name('feature-category.delete');
});


Route::group(['prefix' => 'shop-settings'], function () {
    Route::get('/', 'ShopSettingsController@index')->name('shop-settings.index');
    Route::post('store', 'ShopSettingsController@store')->name('shop-settings.store');
});

Route::group(['prefix' => 'top-selling'], function () {
    Route::get('/', 'TopSellingController@index')->name('top-selling.index');
    Route::get('create', 'TopSellingController@create')->name('top-selling.create');
    Route::post('store', 'TopSellingController@store')->name('top-selling.store');
    Route::delete('delete/{id}', 'TopSellingController@delete')->name('top-selling.delete');
});

Route::group(['prefix' => 'banner-image'], function () {
    Route::get('/', 'BannerImageController@index')->name('banner-image.index');
    Route::get('create', 'BannerImageController@create')->name('banner-image.create');
    Route::post('store', 'BannerImageController@store')->name('banner-image.store');
    Route::delete('delete/{id}', 'BannerImageController@delete')->name('banner-image.delete');
});

Route::group(['prefix' => 'hot-deal'], function () {
    Route::get('/', 'HotDealController@index')->name('hot-deal.index');
    Route::get('create', 'HotDealController@create')->name('hot-deal.create');
    Route::post('store', 'HotDealController@store')->name('hot-deal.store');
    Route::get('edit/{id}', 'HotDealController@edit')->name('hot-deal.edit');
    Route::put('update/{id}', 'HotDealController@update')->name('hot-deal.update');
    Route::delete('delete/{id}', 'HotDealController@delete')->name('hot-deal.delete');
});
