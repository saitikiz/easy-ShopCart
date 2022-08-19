<?php

Auth::routes();


Route::get('/', function () {
    return redirect()->route('frontend.products.index');
})->name('home');

Route::group(['as' => 'frontend.', 'namespace' => 'Frontend'], function () {

    // Product
    Route::resource('products', 'ProductController');
});

Route::group(['as' => 'frontend.', 'namespace' => 'Frontend', 'middleware' => ['auth']], function () {


    Route::get("cart","CartController@index")->name("cart.index");
    Route::post("cart/item-count","CartController@itemCount")->name("cart.itemCount");
    Route::post("cart/add","CartController@add")->name("cart.add");
    Route::post("cart/remove","CartController@remove")->name("cart.remove");
    Route::post("cart/update","CartController@update")->name("cart.update");
    Route::post("cart/truncate","CartController@truncate")->name("cart.remove");

    Route::get('frontend/profile', 'ProfileController@index')->name('profile.index');
    Route::post('frontend/profile', 'ProfileController@update')->name('profile.update');
    Route::post('frontend/profile/destroy', 'ProfileController@destroy')->name('profile.destroy');
    Route::post('frontend/profile/password', 'ProfileController@password')->name('profile.password');
});
