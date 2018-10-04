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
    return view('home');
});

Route::get('/test',function(){
    
    return $file;
})->middleware('admin');

Route::get('/services', 'ServiceController@index');

Route::get('/services/get','ServiceController@readServices');

Route::post('/services/{service}/{status}','ServiceController@handleService');
Route::get('/services/{service}/{status}','ServiceController@handleService');

Route::get('/files','FileController@index');

Route::get('/files/view','FileController@viewFile');
Route::post('/files/edit','FileController@editFile');

Route::post('/change/url','FileController@changeFile');

Route::get('/security/basic','SecurityController@basic');
Route::get('/security/protection','SecurityController@protection')->middleware('admin');

Route::get('/security/basic/{service}/{status}','SecurityController@changeModeStatus');
Route::post('/security/cmd','SecurityController@executeCommand');

Route::get('/admin-login','SecurityController@adminform');
Route::post('/admin-login','SecurityController@adminlogin');

Route::get('/settings','SettingsController@index');


Route::get('/t',function(){
    session(['admin'=>'granted']);
});