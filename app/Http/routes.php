<?php

Route::get('/', [
    'uses' => 'ProductController@getIndex',
    'as' => 'product.index'
]);

Route::group(['middleware' => 'auth'], function(){
    Route::resource('products','ProductController');
});

Route::get('/add-to-cart/{id}',[
    'uses' => 'ProductController@getAddToCart',
    'as' => 'product.addToCart'
]);

Route::get('/reduce/{id}',[
    'uses' => 'ProductController@getReduceByOne',
    'as' => 'product.reduceByOne'
]);

Route::get('/remove/{id}',[
    'uses' => 'ProductController@getRemoveItem',
    'as' => 'product.remove'
]);

Route::get('/shopping-cart',[
    'uses' => 'ProductController@getCart',
    'as' => 'product.shoppingCart'
]);

Route::get('/checkout', [
    'uses' => 'ProductController@getCheckout',
    'as' => 'checkout',
    'middleware' => 'auth'
]);

Route::post('/checkout', [
    'uses' => 'ProductController@postCheckout',
    'as' => 'checkout',
    'middleware' => 'auth'
]);



Route::group(['prefix'=> 'admin'], function(){
  Route::group(['middleware' => 'admin'], function(){
    Route::get('/orders', [
      'uses' => 'AdminController@getOrders',
      'as' => 'admin.orders'
    ]);

    Route::get('/users', [
      'uses' => 'AdminController@getUsers',
      'as' => 'admin.users'
    ]);

    Route::get('/products', [
      'uses' => 'AdminController@getProducts',
      'as' => 'admin.products'
    ]);

  });
});



Route::group(['prefix'=> 'user'], function(){
  Route::group(['middleware' => 'guest'], function(){
    Route::get('/{id}/edit', [
      'uses' => 'UserController@getEdit',
      'as' => 'user.edit'
    ]);

    Route::post('/{id}/edit', [
      'uses' => 'UserController@postEdit',
      'as' => 'user.edit'
    ]);

    Route::get('/signup', [
      'uses' => 'UserController@getSignup',
      'as' => 'user.signup'
    ]);

    Route::post('/signup', [
      'uses' => 'UserController@postSignup',
      'as' => 'user.signup'
    ]);

    Route::get('/signin', [
      'uses' => 'UserController@getSignin',
      'as' => 'user.signin'
    ]);

    Route::post('/signin', [
      'uses' => 'UserController@postSignin',
      'as' => 'user.signin'
    ]);
  });


  Route::group(['middleware' => 'auth'], function(){
    Route::get('profile', [
        'uses' => 'UserController@getProfile',
        'as' => 'user.profile'
    ]);

    Route::post('profile', [
        'uses' => 'UserController@updateAvatar',
        'as' => 'user.updateAvatar'
    ]);

    Route::get('/logout', [
        'uses' => 'UserController@getLogout',
        'as' => 'user.logout'
    ]);
  });
});
