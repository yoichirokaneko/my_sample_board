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

//トップページへのアクセス時に起動するメソッドを指定
Route::get('/', 'PostController@index');

//->middleware('auth')を使用することで、このルートには、ログインしていないと飛べなくなる。ログインしていない場合は、ログイン画面に飛ぶ
Route::get('/post/create', 'PostController@create')->middleware('auth');

//新規投稿ページで記載した内容をpostsテーブルに書き込む処理を行うメソッドを呼び出す
Route::post('post/create', 'PostController@store');

// Authのインポートで記述された処理。よく把握してません。
Auth::routes();

// authのインポートで記述された処理。よく把握してません。
Route::get('/home', 'HomeController@index')->name('home');

// 投稿の詳細ページへ遷移する処理を行うメソッドを呼び出す
Route::get('/post/{post_id}/show', 'PostController@show')->name('show');

// 投稿を編集するページに遷移する処理を行うメソッドを呼び出す
Route::get('/post/{post_id}/edit', 'PostController@edit');

// 投稿を編集する際に編集したデータをデータベースに投稿する処理を行うメソッドを呼び出す
Route::post('/post/{post_id}/edit', 'PostController@update');

// コメントの書き込みは、ログインしているユーザーでなければ行えないようにするため、middlewareを使用
Route::post('/post/{post_id}/show', 'CommentController@store')->middleware('auth');

// 投稿の削除ボタンをクリックした際に、発動するデータベース上の投稿を削除するメソッドを呼び出す
Route::delete('/post/{post_id}','PostController@delete');

// 既存のコメントの編集ページを開くメソッドを呼び出す
Route::get('/comment/{comment_id}/edit', 'CommentController@edit');
// 既存のコメントの編集ページで記述した内容をデータベースに更新するメソッドを呼び出す
Route::post('/comment/{comment_id}/edit', 'CommentController@update');

// コメントの削除ボタンをクリックした際に発動するデータベース上のコメントを削除するメソッドを呼び出す
Route::delete('/comment/{comment_id}', 'CommentController@delete');
