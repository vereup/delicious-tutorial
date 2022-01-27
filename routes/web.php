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


Route::get('/','MainController@getMainDatas')->name('home');

Route::get('/signup', 'SignupController@getSignupDatas');

Route::get('/review', function () {
    return view('review',['name' => 'Justin']);
});

Route::get('/mypage','MypageController@getMypageDatas')->middleware('auth');

Route::get('/store/{storeId}','DetailController@getStoreDatas');

Route::get('/test', function () {
    return view('test',['name' => 'Justin']);
});


Auth::routes();

Route::get('/home', 'HomeController@index');
