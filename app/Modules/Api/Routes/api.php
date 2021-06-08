<?php

use Illuminate\Support\Facades\Route;

Route::post('/media', 'MediaController@storeMedia')->name('media.storeMedia');
Route::get('/member/{id}', 'MemberController@show')->name('member.show');

Route::group(['prefix' => 'v1'], function () {
    Route::get('areas/{id}/prefectures', 'AreaController@getListPrefecture')->name('area.getPrefectures');
    Route::post('users/{id}/favorite', 'FavoriteController@toggle')->name('favorites');
    Route::put('member/{id}/status', 'MemberController@updateStatus')->name('member.status');
    Route::get('offers/{id}', 'OfferController@add')->name('offer.add');
    Route::delete('offers/{id}', 'OfferController@destroy')->name('offer.destroy');
    Route::post('product/cart', 'ProductController@productCart')->name('product.cart');
    Route::post('product/review', 'ProductController@productReview')->name('product.review');
    Route::post('product/comment', 'ProductController@productComment')->name('product.comment');
    Route::post('cart/delete-product/{id}', 'CartController@deleteProduct')->name('cart.deleteProduct');
});
