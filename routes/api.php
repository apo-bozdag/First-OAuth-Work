<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::group(['middleware' => ['auth:api']], function () {

    Route::get('/user',function (Request $request){
        return $request->user();
    });

    Route::get('/check', function (Request $request) {
        if ($request->user()->tokenCan('check')) {
            return 'check';
        }else{
            return 'no check';
        }
    });

    Route::get('/place', function (Request $request) {
        if ($request->user()->tokenCan('place')) {
            return 'place';
        }else{
            return 'no place';
        }
    });

    Route::get('/deneme', function (Request $request) {
        if ($request->user()->tokenCan('deneme')) {
            return 'deneme';
        }else{
            return 'no deneme';
        }
    });

    Route::get('/orders', function () {
        return 'orders';
    })->middleware('scopes:deneme,place');


});





