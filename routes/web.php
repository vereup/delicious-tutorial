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
    return view('main',['name' => 'Justin']);
});

Route::get('/signup', function () {
    return view('signup',['name' => 'Justin']);
});

Route::get('/review', function () {
    return view('review',['name' => 'Justin']);
});

Route::get('/mypage', function () {
    return view('mypage',['name' => 'Justin']);
});

Route::get('/detail', function () {
    return view('detail',['name' => 'Justin']);
});

Route::get('/write', function () {
    return view('write',['name' => 'Justin']);
});
