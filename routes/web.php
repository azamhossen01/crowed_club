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

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::group(['middleware'=>'auth'],function(){
    Route::get('edit_member','MemberController@edit_member')->name('edit_member');
    Route::post('update_member','MemberController@update_member')->name('update_member');
    Route::resource('members','MemberController');
    Route::get('edit_payment','PaymentController@edit_payment')->name('edit_payment');
    Route::post('update_payment','PaymentController@update_payment')->name('update_payment');
    Route::resource('payments','PaymentController');
});
