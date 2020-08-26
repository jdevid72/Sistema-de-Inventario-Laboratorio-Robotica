<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;


Auth::routes();


Route::group(['middleware' => 'api', 'prefix' => 'auth'],function ($router) {
    Route::post('login', 'AuthController@login');
    Route::post('register', 'AuthController@register');
    Route::post('logout', 'AuthController@logout');
    Route::post('refresh', 'AuthController@refresh');
    Route::post('me', 'AuthController@me');
});

/*
Route::prefix('v1')->group(function(){

    Route::prefix('auth')->group(function(){
        Route::middleware('auth:api')->group(function(){
    Route::get('users', 'AuthController@getUser');
        });
    });

});
*/

Route::middleware('api')->get('/user', function (Request $request) {
    return $request->user();
});




Route::group(['middleware' => 'api','namespace'=>'Api'],function ($router) {


    Route::apiResource('tipos', 'TipoController');

    

    Route::apiResource('products','ProductController');



    Route::apiResource('personas', 'PersonaController');

    Route::apiResource('materials', 'MaterialController');



    Route::apiResource('prestamos', 'PrestamoController');
    


    
});


