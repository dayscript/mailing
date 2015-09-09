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

Route::post('webhook', ['as' => 'webhook', 'uses' => 'MailController@webhook'] );
Route::post('send', ['as' => 'send', 'uses' => 'MailController@navidad'] );
Route::get('contact', ['as' => 'contact', 'uses' => 'MailController@index'] );
