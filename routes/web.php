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
//web
Route::get('/', 'Web\HomeController@index')->name('home');

Route::get('/{column}', 'Web\ColumnsController@index')->where('column','^(?!admin|storage|api|\/)[\.\-\w]+$');

Route::get('/{column}/{content}', 'Web\ContentsController@index')->where([
    'column'=>'^(?!admin|storage|api|\/)[\.\-\w]+$',
    'content'=>'^(?!\/)[\.\w]+$'
]);

//
//Route::get('/cases', function () {
//    return view('cases');
//})->name('cases');
//
//Route::get('/about', function () {
//    return view('about');
//})->name('about');
//
//
//Route::get('/technical', function () {
//    return view('technical');
//})->name('technical');
//
//Route::get('/contact', function () {
//    return view('contact');
//})->name('contact');
//
//Route::get('/exhibition', function () {
//    return view('exhibition');
//})->name('exhibition');
//
//
//Route::get('/newest', function () {
//    return view('newest');
//})->name('newest');
//
//Route::get('/oldnew', function () {
//    return view('oldnew');
//})->name('oldnew');
//

//后台
Route::group(['middleware' => 'auth','prefix' => 'admin'], function () {
    Route::get('/','Admin\IndexsController@index')->name('admin');
    Route::get('logout','Admin\LoginsController@destroy')->name('logout');
    //栏目管理
    Route::resource('columns','Admin\ColumnsController');
    Route::resource('contents','Admin\ContentsController');
    Route::resource('users','Admin\UsersController');
    Route::resource('files','Admin\FilesController');
});

Route::group(['prefix' => 'storage'], function () {
    Route::get('/{file}','Admin\FilesController@show')->where('file','.*');
});



Route::group(['middleware' => 'auth','prefix' => 'api'], function () {
    Route::post('/files','Api\FilesController@store');
});



Route::get('admin/login','Admin\LoginsController@create')->name('login');
Route::post('admin/login','Admin\LoginsController@store')->name('login');


//Route::get('/help','StaticPagesController@help');
