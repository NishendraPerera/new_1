<?php

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

// Route::get('/', function () {
//     return view('welcome');
// });

Route::get('/', 'FrontendController@index')->name('index');

Route::get('articles', 'FrontendController@articles')->name('articles');
Route::get('videos', 'FrontendController@videos')->name('videos');

Route::get('video/{id}', 'FrontendController@single_video')->name('single_video');

Route::get('contact', 'FrontendController@contact')->name('contact');
Route::get('about us', 'FrontendController@about')->name('about us');

// //Route::get('ajaxRequest', 'SubscribeController@ajaxRequest')->name('subscribe');

// //Route::post('ajaxRequest', 'SubscribeController@ajaxRequestPost')->name('subscribe');

Route::get('/logout', 'HomeController@home')->name('home')->middleware('auth');

Auth::routes();

Route::get('/home', 'HomeController@home')->name('home')->middleware('auth');

Route::group(['prefix' => 'settings'], function () {
    Route::get('home', 'SettingController@home')->name('setting.home');
    Route::post('change', 'SettingController@change')->name('setting.change');
    Route::get('slider', 'SettingController@slider')->name('setting.slider');
    Route::get('slider/list', 'SettingController@slider_list')->name('setting.slider.list');
    Route::post('slider/store', 'SettingController@slider_store')->name('setting.slider.store');
    Route::post('slider/delete', 'SettingController@slider_delete')->name('setting.slider.delete');
});

Route::group(['prefix' => 'user/management'], function () {
    Route::get('home', 'UserManagementController@home')->name('user.management.home');
    Route::get('users_home', 'UserManagementController@users_home')->name('user.management.users_home');
    Route::get('employees_home', 'UserManagementController@employees_home')->name('user.management.employees_home');
    Route::get('new_home', 'UserManagementController@new_home')->name('user.management.new_home');
    Route::get('users', 'UserManagementController@users')->name('user.management.users');
    Route::get('employees', 'UserManagementController@employees')->name('user.management.employees');
    Route::get('create', 'UserManagementController@create')->name('user.management.create');
    Route::get('store', 'UserManagementController@store')->name('user.management.store');
    Route::get('show/{id}', 'UserManagementController@show')->name('user.management.show');
    Route::get('edit/{id}', 'UserManagementController@edit')->name('user.management.edit');
    Route::post('update/{id}', 'UserManagementController@update')->name('user.management.update');
    Route::post('delete', 'UserManagementController@destroy')->name('user.management.delete');
});

Route::group(['prefix' => 'article'], function () {
    Route::get('home', 'ArticleController@home')->name('article.home');
    Route::get('index', 'ArticleController@index')->name('article.index');
    Route::get('create', 'ArticleController@create')->name('article.create');
    Route::post('store', 'ArticleController@store')->name('article.store');
    Route::get('show/{id}', 'ArticleController@show')->name('article.show');
    Route::get('edit/{id}', 'ArticleController@edit')->name('article.edit');
    Route::post('update/{id}', 'ArticleController@update')->name('article.update');
    Route::post('delete', 'ArticleController@destroy')->name('article.delete');
});

Route::get('article/{id}', 'FrontendController@single')->name('single');

Route::post('ad-store', 'AdvertisementController@store')->name('advertisement.store');
Route::get('ad-index', 'AdvertisementController@index')->name('advertisement.index');
Route::post('ad-update/{id}', 'AdvertisementController@update')->name('advertisement.update');
Route::post('ad-del', 'AdvertisementController@destroy')->name('advertisement.delete');

Route::post('price_store', 'AdvertisementController@price_store')->name('advertisement.price_store')->middleware('auth');
Route::get('price_list', 'AdvertisementController@price_list')->name('advertisement.price_list')->middleware('auth');
Route::get('price_show', 'AdvertisementController@price_show')->name('advertisement.price_show')->middleware('auth');
Route::post('price_edit', 'AdvertisementController@price_edit')->name('advertisement.price_edit')->middleware('auth');
Route::get('price_ajax', 'AdvertisementController@price_ajax')->name('advertisement.price_ajax')->middleware('auth');

Route::group(['prefix' => 'advertisement'], function () {
    Route::get('home', 'AdvertisementController@home')->name('advertisement.home');
    //Route::get('index', 'AdvertisementController@index')->name('advertisement.index');
    Route::get('create', 'AdvertisementController@create')->name('advertisement.create');
    //Route::post('store', 'AdvertisementController@store')->name('advertisement.store');
    Route::get('show/{id}', 'AdvertisementController@show')->name('advertisement.show');
    Route::get('edit/{id}', 'AdvertisementController@edit')->name('advertisement.edit');
    //Route::post('update/{id}', 'AdvertisementController@update')->name('advertisement.update');
    //Route::post('delete', 'AdvertisementController@destroy')->name('advertisement.delete');

    Route::get('price', 'AdvertisementController@price')->name('advertisement.price');
});

Route::group(['prefix' => 'previous'], function () {
    Route::get('home', 'PreviousPaperController@home')->name('previous.home');
    Route::get('index', 'PreviousPaperController@index')->name('previous.index');
    Route::get('create', 'PreviousPaperController@create')->name('previous.create');
    Route::post('store', 'PreviousPaperController@store')->name('previous.store');
    Route::get('show/{id}', 'PreviousPaperController@show')->name('previous.show');
    Route::get('edit/{id}', 'PreviousPaperController@edit')->name('previous.edit');
    Route::post('update/{id}', 'PreviousPaperController@update')->name('previous.update');
    Route::post('delete', 'PreviousPaperController@destroy')->name('previous.delete');
});

Route::group(['prefix' => 'video'], function () {
    Route::get('home', 'VideoController@home')->name('video.home');
    Route::get('index', 'VideoController@index')->name('video.index');
    Route::get('create', 'VideoController@create')->name('video.create');
    Route::post('store', 'VideoController@store')->name('video.store');
    Route::get('show/{id}', 'VideoController@show')->name('video.show');
    Route::get('edit/{id}', 'VideoController@edit')->name('video.edit');
    Route::post('update/{id}', 'VideoController@update')->name('video.update');
    Route::post('delete', 'VideoController@destroy')->name('video.delete');
});

Route::group(['prefix' => 'order'], function () {
    Route::get('home', 'OrderController@home')->name('order.home');
    Route::get('index', 'OrderController@index')->name('order.index');
    Route::get('create', 'OrderController@create')->name('order.create');
    Route::post('store', 'OrderController@store')->name('order.store');
    Route::get('show/{id}', 'OrderController@show')->name('order.show');
    Route::get('edit/{id}', 'OrderController@edit')->name('order.edit');
    Route::post('update/{id}', 'OrderController@update')->name('order.update');
    Route::post('delete', 'OrderController@destroy')->name('order.delete');
});

Route::group(['prefix' => 'report', 'middleware' => 'auth'], function () {
    Route::get('advertisement', 'ReportController@advertisement')->name('report.advertisement');
    Route::get('ad_list', 'ReportController@ad_list')->name('report.ad_list');
    Route::get('article_report', 'ReportController@article_report')->name('report.article_report');
    Route::get('article', 'ReportController@article')->name('report.article');
});



// Auth::routes();

// Route::get('/home', 'HomeController@index')->name('home');
