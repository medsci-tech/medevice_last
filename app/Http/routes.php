<?php

Route::get('/', function () {
    return view('welcome');
});

Route::group(['middleware' => ['web']], function () {
    Route::group(['prefix' => 'wechat', 'namespace' => 'Wechat'], function () {
        Route::any('/', 'WechatController@serve');
        Route::get('/menu', 'WechatController@menu');
    });

    Route::group(['prefix' => 'register', 'namespace' => 'Register'], function () {
        Route::get('/set-pwd', 'RegisterController@setPwdForm');
        Route::post('/set-pwd', 'RegisterController@setPwd');
        Route::get('/create', 'RegisterController@create');
        Route::post('/store', 'RegisterController@store');
        Route::any('/send-message', 'RegisterController@sendMessage');
        Route::any('/agreement', function () {
            return view('register.agreement');
        });
    });

    Route::group(['prefix' => 'shop', 'namespace' => 'Shop'], function () {
        Route::get('/', 'ShopController@index');
        Route::any('/get-products-by-cat-id', 'ShopController@getProductByCatID');
        Route::get('/detail', 'ShopController@detail');
        Route::get('/info', 'ShopController@info');
        Route::any('/create-order', 'ShopController@createOrder');
        Route::any('/cancel-order', 'ShopController@cancelOrder');
        Route::any('/collect', 'ShopController@collect');
        Route::any('/cancel-collect', 'ShopController@cancelCollect');
        Route::any('/video', 'ShopController@video');
    });

    Route::group(['prefix' => 'supplier', 'namespace' => 'Supplier'], function () {
        Route::get('/', 'SupplierController@index');
        Route::get('/detail', 'SupplierController@detail');
        Route::any('/follow', 'SupplierController@follow');
        Route::any('/unfollow ', 'SupplierController@unfollow');
    });

    Route::group(['prefix' => 'personal', 'namespace' => 'Personal'], function () {
        Route::get('/', 'PersonalController@index');
        Route::get('/order-list', 'PersonalController@orderList');
        Route::get('/collection-list', 'PersonalController@collectionList');
        Route::get('/attention-list', 'PersonalController@attentionList');
    });
    Route::group(['prefix' => 'apply', 'namespace' => 'Apply'], function () {
        Route::any('/', 'ApplyController@index');
        Route::get('/success', 'ApplyController@success');
    });

    Route::group(['prefix' => 'article', 'namespace' => 'Article'], function () {
        Route::get('/', 'ArticleController@index');
    });

    Route::get('/about-us', function () {
        return view('about-us');
    });
    Route::get('/unfinished', function () {
        return view('unfinished');
    });
    Route::get('/video', function () {
        return view('video', ['videos' => \App\Models\ProductVideo::all()]);
    });

    Route::get('/mime-video', function () {
        return view('video-for-mime');
    });

    Route::get('/phone', function () {
        return view('phone');
    });

    Route::group(['prefix' => 'test'], function () {
        Route::get('/success', 'TestController@success');
    });
});


Route::group(['prefix' => 'admin', 'namespace' => 'Admin'], function () {
    Route::get('/export', 'TestController@export');
    Route::get('/test', 'TestController@test');
});
