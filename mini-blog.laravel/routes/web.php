<?php

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

Route::get('/', function () {
    return view('welcome');
});
// Route::get('/{any}', function () {
//     return view('welcome');
// })->where('any', '.*');

// 新規登録
Route::get('account/signup', 'App\Http\Controllers\AccountController@signup');
Route::post('account/register', 'App\Http\Controllers\AccountController@register');
// 登録内容確認
Route::post('account/confirm', 'App\Http\Controllers\AccountController@confirm');

// 認証関係
Route::get('account/signin', 'App\Http\Controllers\AccountController@signin');
Route::post('account/auth', 'App\Http\Controllers\AccountController@auth');
Route::get('account/signout', 'App\Http\Controllers\AccountController@signout');

// アカウント情報
Route::get('account', 'App\Http\Controllers\AccountController@index')
    ->middleware('auth');
// アカウント一覧
Route::get('account/all', 'App\Http\Controllers\AccountController@showall');

// フォロー
Route::post('follow', 'App\Http\Controllers\AccountController@follow');
// フォロー解除
Route::post('unfollow', 'App\Http\Controllers\AccountController@unfollow');

// ユーザー情報
Route::get('account/profile', 'App\Http\Controllers\AccountController@submitProfile');
Route::post('account/profile', 'App\Http\Controllers\AccountController@createProfile');

// プロフィール画像登録
Route::get('account/image', 'App\Http\Controllers\AccountController@submitImage');
Route::post('account/image', 'App\Http\Controllers\AccountController@createImage');

// お気に入り一覧
Route::get('account/favorites', 'App\Http\Controllers\AccountController@showFavorites');

// ホーム
Route::get('index', 'App\Http\Controllers\PostController@index')
    ->middleware('auth');

// 投稿
Route::post('post', 'App\Http\Controllers\PostController@create');
// 各ユーザーの投稿一覧
Route::get('user/{user}', 'App\Http\Controllers\PostController@user');
// 投稿詳細
Route::get('post/{post}', 'App\Http\Controllers\PostController@show');
// 投稿編集
Route::post('edit/{post}', 'App\Http\Controllers\PostController@edit');
// 投稿削除
Route::get('delete/{post}', 'App\Http\Controllers\PostController@delete');

// 返信
Route::post('reply/{post}', 'App\Http\Controllers\ReplyController@reply');
// 返信詳細
Route::get('post/{post}/reply/{reply}', 'App\Http\Controllers\ReplyController@show');
// 再返信
Route::post('comment/post/{post}/reply/{reply}', 'App\Http\Controllers\ReplyController@comment');

// お気に入り登録
Route::post('favor', 'App\Http\Controllers\PostController@favor');
// フォロー解除
Route::post('unfavor', 'App\Http\Controllers\PostController@unfavor');




Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
