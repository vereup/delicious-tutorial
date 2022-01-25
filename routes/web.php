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


Route::get('/','MainController@getMainDatas');

Route::get('/signup', function () {
    return view('signup',['name' => 'Justin']);
});

Route::get('/review', function () {
    return view('review',['name' => 'Justin']);
});

Route::get('/mypage','MypageController@getMypageDatas');


Route::get('/store/{storeId}','DetailController@getStoreDatas');


Route::get('/detailWrite', function () {
    return view('detailWrite',['name' => 'Justin']);
});

Route::get('/detailReview', function () {
    return view('detailReview',['name' => 'Justin']);
});

Route::get('/test', function () {
    return view('test',['name' => 'Justin']);
});

