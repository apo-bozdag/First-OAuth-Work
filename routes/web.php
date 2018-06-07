<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

use Illuminate\Http\Request;

Route::get('/', 'HomeController@index')->name('home');

Route::group(['prefix' => 'admin', 'middleware' => ['admin'], 'namespace' => 'Admin'], function () {
    CRUD::resource('tag', 'TagCrudController');
    CRUD::resource('article', 'ArticleCrudController');
    Route::get('test/ajax-category-options', 'CategoryCrudController@categoryOptions');
    CRUD::resource('test', 'CategoryCrudController');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
Route::get('/face', 'HomeController@face')->name('face');


