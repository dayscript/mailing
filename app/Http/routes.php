<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/


Route::get('/', [
    'as' => 'home',
    'uses' => 'HomeController@index'
]);
//Route::get('report','HomeController@report');

Route::any('webhook', ['as' => 'webhook', 'uses' => 'MailController@webhook'] );
Route::post('navidad', ['as' => 'navidad', 'uses' => 'MailController@navidad4'] );
Route::post('navidadcontador23', ['as' => 'navidadcontador23', 'uses' => 'MailController@navidadcontador23'] );
Route::post('navidad16dias', ['as' => 'navidad16dias', 'uses' => 'MailController@navidad16dias'] );
Route::post('navidad10dias', ['as' => 'navidad10dias', 'uses' => 'MailController@navidad10dias'] );
Route::post('navidadfinal', ['as' => 'navidadfinal', 'uses' => 'MailController@navidadfinal'] );
Route::post('regalosnavidad', ['as' => 'regalosnavidad', 'uses' => 'MailController@regalosnavidad'] );
Route::any('soydt2016', ['as' => 'soydt2016', 'uses' => 'MailController@soydt2016'] );
Route::post('dotacion', ['as' => 'dotacion', 'uses' => 'MailController@dotacion'] );
Route::get('contact', ['as' => 'contact', 'uses' => 'MailController@index'] );
Route::get('clean', ['as' => 'clean', 'uses' => 'MailController@clean'] );
Route::get('report', ['as' => 'report', 'uses' => 'MailController@report'] );
