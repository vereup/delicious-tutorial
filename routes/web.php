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

Route::middleware(['auth'])->group(function () {
    Route::get('/mypage','MypageController@getMypageDatas');
    Route::post('/mypage','MypageController@getMypageDatas')->name('modifyReview');
});




Route::get('/store/{storeId}','DetailController@getStoreDatas');

Route::get('/test','TestController@getTestDatas');



Auth::routes();

Route::get('/home', 'HomeController@index');
