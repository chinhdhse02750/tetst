<?php
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\App;

App::bind('view.finder', function ($app) {
    $paths = [realpath(app_path('Modules/Member/Views'))];
    return new \Illuminate\View\FileViewFinder($app['files'], $paths);
});
Route::group([['middleware' => 'auth']], function () {
    Route::get('/', 'HomeController@index')->name('home');
    Route::get('/member/{id}', 'MemberController@show')->name('member.detail');
    Route::get('/balances', 'BalanceController@index')->name('balance.index');
    Route::get('/profile', 'ProfileController@index')->name('profile.index');
    Route::post('profile/update', 'ProfileController@update')->name('profile.update');
    Route::get('/profile/change-password', 'ProfileController@password')->name('profile.password');
    Route::post('/profile/change-password', 'ProfileController@changePassword')->name('profile.change-password');
    Route::get('/contact', 'ContactController@create')->name('contact.index');
    Route::post('/store', 'ContactController@store')->name('contact.store');
    Route::get('/favorites', 'FavoriteController@index')->name('favorites');
    Route::get('/offers', 'OfferController@index')->name('offer.index');
    Route::post('/setting-list', 'OfferController@settingList')->name('offer.setting-list');
    Route::post('/setting-detail', 'OfferController@settingDetail')->name('offer.setting-detail');
    Route::post('/setting-confirm', 'OfferController@settingConfirm')->name('offer.setting-confirm');
    Route::get('/offers/detail', 'OfferController@detail')->name('offer.detail');
    Route::get('/offers/confirm', 'OfferController@confirm')->name('offer.confirm');
    Route::get('/offers/success', 'OfferController@success')->name('offer.success');
    Route::get('/offers/{id}/payments/{token}', 'OfferController@redirect')->name('offer.redirect');
    Route::get('/offers/purchase-success', 'PayPalController@purchaseSuccess')->name('paypal.purchase-success');
    Route::get('/paypal/ec-checkout', 'PayPalController@getExpressCheckout')->name('paypal.ec-checkout');
    Route::get('/paypal/ec-checkout-success', 'PayPalController@getExpressCheckoutSuccess');
    Route::get('/history', 'HistoryController@index')->name('history.index');
    Route::get('/history/detail/{id}', 'HistoryController@detail')->name('history.detail');
});
Auth::routes();
Route::get('/test', 'HomeController@test')->name('test');
Route::get('/register', 'Auth\RegisterController@showRegistrationForm')->name('member.register');
Route::post('/register', 'Auth\RegisterController@register')->name('register');
Route::get('/login', 'Auth\LoginController@showLoginForm')->name('login');
Route::post('/login', 'Auth\LoginController@login');
Route::get('/logout', 'Auth\LoginController@logout')->name('logout');
Route::get('/lang/{lang}', 'LanguageController@swap')->name('member.lang');

