<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\App;

App::bind('view.finder', function ($app) {
    $paths = [realpath(app_path('Modules/Admin/Views'))];
    return new \Illuminate\View\FileViewFinder($app['files'], $paths);
});

Route::middleware(['role:super_admin', 'auth:admin'])
    ->group(function () {
        Route::delete('member/{type_user}/{id}', 'UserController@destroy')->name('member.destroy');
        Route::post('member/{type_user}/restore/{id}', 'UserController@restore')->name('member.restore');
        Route::get('balances', 'BalanceController@index')->name('member.balances');
        Route::get('balances/search', 'BalanceController@search')->name('member.search-balances');
        Route::resource('/categories', 'CategoryController');
        Route::resource('/products', 'ProductController');
        Route::resource('/prefectures', 'PrefectureController');
        Route::get('offers/search', 'OfferController@search')->name('offers.search');
        Route::post('/offers/link-to-paypal', 'OfferController@linkPaypal')->name('offers.link-paypal');
        Route::resource('/offers', 'OfferController');
        Route::resource('/ranks', 'RankController');
        Route::post('ranks/restore/{id}', 'RankController@restore')->name('ranks.restore');
        Route::get('/banks/edit', 'BankController@edit')->name('banks.edit');
        Route::post('/banks/edit', 'BankController@store')->name('banks.store');
        Route::resource('/accounts', 'AccountController');
        Route::post('accounts/restore/{id}', 'AccountController@restore')->name('accounts.restore');
        Route::resource('/units', 'UnitController');
        Route::resource('/tags', 'TagController');
    });

Route::middleware('auth:admin')
    ->group(function () {
        Route::get('/', 'HomeController@index')->name('admin.welcome');
        Route::get('/dashboard', 'HomeController@dashboard')->name('admin.dashboard');
        Route::resource('/banners', 'BannerController');
        Route::get('news/search', 'NewsController@search')->name('news.search');
        Route::resource('/news', 'NewsController');
        Route::get('member/{type_user}', 'UserController@index')->name('member.index');
        Route::get('member/{type_user}/create', 'UserController@create')->name('member.create');
        Route::get('member/{type_user}/edit/{id}', 'UserController@edit')->name('member.edit');
        Route::get('member/{type_user}/{id}', 'UserController@show')->name('member.show');
        Route::post('member/{type_user}/create', 'UserController@store')->name('member.store');
        Route::put('member/{type_user}/{id}', 'UserController@update')->name('member.update');
        Route::post('member/{type_user}/preview', 'UserController@preview')->name('member.preview');
        Route::get('member/{type_user}/preview', 'UserController@preview')->name('member.preview');
        Route::post('member/{type_user}/point-send', 'AdjustmentController@storeAdjustment')
            ->name('member.update-point-send');
        Route::get('member/{type_user}/point-send/{id}', 'AdjustmentController@createAdjustment')
            ->name('member.point-send');
        Route::get('search-member', 'UserController@search')->name('members.search');
        Route::get('contact', 'ContactController@index')->name('contact.index');
        Route::get('contact/edit/{id}', 'ContactController@edit')->name('contact.edit');
        Route::put('contact/{id}', 'ContactController@update')->name('contact.update');
    });

Route::get('/login', 'Auth\LoginController@showLoginForm')->name('admin.login');
Route::post('/login', 'Auth\LoginController@login')->name('admin.login');
Route::get('/logout', 'Auth\LoginController@logout')->name('admin.logout');
Route::get('/lang/{lang}', 'LanguageController@swap')->name('admin.lang');
