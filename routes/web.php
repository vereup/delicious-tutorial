<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;


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

Auth::routes();

Route::get('/','MainController@getMainDatas')->name('home');
Route::post('/removeWish','MainController@removeWish')->name('removeWish');
Route::post('/addWish','MainController@addWish')->name('addWish');

Route::get('/search','MainController@sea rch')->name('search');

Route::get('/signup', 'SignupController@getSignupDatas');

Route::get('/review', function () {
    return view('review',['name' => 'Justin']);
});

Route::middleware(['auth'])->prefix('mypage')->group(function () {
    Route::get('','MypageController@getMypageDatas')->name('mypage');
    Route::post('modify','MypageController@modifyReview')->name('modifyReview');
    Route::post('deleteReview','MypageController@deleteReview')->name('deleteReview');
    Route::post('deleteWish','MypageController@deleteWish')->name('deleteWish');
});

Route::get('/store/{storeId}','DetailController@getStoreDatas');
Route::post('/store','DetailController@writeReview')->name('writeReview');
Route::get('/test','TestController@getTestDatas');

Route::middleware(['admin'])->prefix('admin')->group(function () {
    Route::get('', 'AdminController@getAdminDatas')->name('admin');
    Route::post('deleteStore', 'AdminController@deleteStore')->name('deleteStore');
    Route::get('search', 'AdminController@getAdminDatas')->name('adminSearch');
    Route::get('regist', 'AdminController@getRegistDatas')->name('regist');
    Route::post('registStore', 'AdminController@registStores')->name('registStore');
    Route::get('modify/{storeId}', 'AdminController@getModifyStoresDatas')->name('modify');
    Route::post('modifyStore', 'AdminController@modifyStores')->name('modifyStore');
});