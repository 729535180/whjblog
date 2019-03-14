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

Route::get('/', function () {
    return view('welcome');
});

Route::get('admin/login','Admin\LoginController@login');
Route::get('admin/index','Admin\IndexController@index');
Route::get('admin/json/menu','Admin\IndexController@menu');
Route::get('/admin/json/menu/{name}','Admin\IndexController@menu',function($name = 'abc'){
    return $name;
})->name('profile');
Route::get('view','Home\IndexController@index');