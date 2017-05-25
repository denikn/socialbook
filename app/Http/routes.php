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
/*Route::get('auth/login', 'Auth\AuthController@getLogin');
Route::post('auth/login', 'Auth\AuthController@postLogin');
Route::get('auth/logout', 'Auth\AuthController@getLogout');*/

Route::get('/', function () {
    return view('welcome');
});

// USER
Route::get('get_user/all', 'UserController@index');
Route::get('get_user/uid={uid}', 'UserController@getByUid');

Route::get('get_user/email={email}&password={password}', 'UserController@login');

Route::post('get_user/register', 'UserController@register');
Route::get('get_user/name={name}', 'UserController@getByName');

// FRIENDS
Route::get('get_friend/uid={uid}', 'FriendController@getByUid');
Route::post('get_friend/add', 'FriendController@addFriend');

// ---- konfirmasi
Route::get('get_friend/friendrequest={friend}', 'FriendController@getFriendRequest');
Route::get('get_friend/search={name}', 'FriendController@getByName');

Route::put('get_friend/confirm', 'FriendController@confirm');
Route::delete('get_friend/decline', 'FriendController@decline');
Route::post('get_friend/remove', 'FriendController@remove');

// BOOK
Route::get('get_book/title={title}', 'BookController@getByTitle');
Route::get('get_book/id={id_books}', 'BookController@getById');
Route::get('get_book/messageboard/title={title}', 'BookController@getWithMessageboard');
Route::get('get_book/messageboard/id_books={id_books}&id_chapter={id_chapter}', 'BookController@showMessageboard');
Route::get('get_book/notes/title={title}', 'BookController@getWithNotes');
Route::delete('get_book/delete', 'BookController@deleteBook');
Route::put('get_book/updatenotes', 'BookController@updateNotes');

	// Messageboard
Route::post('get_book/sendmessageboard', 'BookController@sendMessageboard');
Route::get('get_book/messageboard/check/id_books={id_books}&id_chapter={id_chapter}', 'BookController@checkUpdateMessageboard');

//NOTES
Route::get('get_book/notes/{uid}/id_books={id_books}&id_chapter={id_chapter}', 'BookController@getNotes');
Route::post('get_book/notes/sendnotes', 'BookController@addNotes');
Route::delete('get_book/notes/deletenotes', 'BookController@deleteNotes');


//LIBRARY and BOOKMARK
Route::post('get_book/sendbookmark', 'BookController@sendBookmark');
Route::post('get_book/sendbookmarkchapter', 'BookController@sendBookmarkChapter');
Route::post('get_book/sendlibrary', 'BookController@sendLibrary');
Route::get('get_book/bookmark={uid}', 'BookController@getBookmark');
Route::get('get_book/library={uid}', 'BookController@getLibrary');
Route::delete('get_book/bookmark/deletebookmark', 'BookController@deleteBookFromBookmark');
Route::delete('get_book/bookmark/deletebookmarkchapter', 'BookController@deleteChapterFromBookmark');
Route::auth();

// ----------------- MEDIA -----------------------
Route::get('get_media/image/id_books={id_books}&id_chapter={id_chapter}', 'BookController@getImage');
Route::get('get_media/audio/id_books={id_books}&id_chapter={id_chapter}', 'BookController@getAudio');
Route::get('get_media/video/id_books={id_books}&id_chapter={id_chapter}', 'BookController@getVideo');

Route::get('/home', 'HomeController@index');
