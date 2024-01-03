<?php
    $controller = "App\Modules\Files\Document\Controllers";

    Route::group(['namespace' => $controller], function(){

        Route::get('/index', [
            'as' => 'docs.index',
            'uses' => 'DocumentController@index'
        ]);

        Route::post('/search', [
            'as' => 'contracts.search',
            'uses' => 'ContractController@search'
        ]);

        Route::get('/getContractForm', [
            'as' => 'contracts.getContractForm',
            'uses' => 'ContractController@getContractForm'
        ]);

        Route::post('/save', [
            'as' => 'contracts.save',
            'uses' => 'ContractController@save'
        ]);

        Route::post('/delete', [
            'as' => 'contracts.delete',
            'uses' => 'ContractController@delete'
        ]);

    });
