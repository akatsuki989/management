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

// ログイン画面を表示
Route::get('/', 'ProductController@showLogin')->name('login');
// ログインする
Route::post('/signin', 'ProductController@postSignin')->name('signin');

// 新規登録画面を表示
Route::get('/insert', 'ProductController@showInsert')->name('insert');
// 新規登録をする
Route::post('/insert/user', 'ProductController@postUser')->name('user');

// 商品情報一覧画面を表示
Route::get('/product', 'ProductController@showList')->name('Products');

// 商品情報新規登録画面を表示
Route::get('/create', 'ProductController@showCreate')->name('create');
// 商品情報を登録
Route::post('/create/store', 'ProductController@exeStore')->name('store');

// 商品情報詳細画面を表示
Route::get('/product/detail/{id}', 'ProductController@showDetail')->name('show');

// 商品情報編集画面を表示
Route::get('/product/edit/{id}', 'ProductController@showEdit')->name('edit');
// 編集する
Route::post('/product/update', 'ProductController@exeUpdate')->name('update');

// 商品情報削除
Route::post('/product/delete/{id}', 'ProductController@exeDelete')->name('delete');