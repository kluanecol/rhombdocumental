<?php
    $controller = "App\Modules\Files\Document\Controllers";

    Route::group(['namespace' => $controller], function(){

        Route::get('/index', [
            'as' => 'docs.index',
            'uses' => 'DocumentController@index'
        ]);

        Route::get('/create', [
            'as' => 'docs.create',
            'uses' => 'DocumentController@create'
        ]);

        Route::post('/save', [
            'as' => 'docs.save',
            'uses' => 'DocumentController@save'
        ]);

    });
