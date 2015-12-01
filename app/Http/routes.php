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
Route::get('report','HomeController@report');

Route::any('webhook', ['as' => 'webhook', 'uses' => 'MailController@webhook'] );
Route::post('navidad', ['as' => 'navidad', 'uses' => 'MailController@navidad4'] );
Route::post('dotacion', ['as' => 'dotacion', 'uses' => 'MailController@dotacion'] );
Route::get('contact', ['as' => 'contact', 'uses' => 'MailController@index'] );
Route::get('clean', ['as' => 'clean', 'uses' => 'MailController@clean'] );
