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

/*Route::get('/', function () {
    return view('welcome');
});*/

Auth::routes();

Route::get('/', 'HomeController@index');

Route::get('department', 'DepartmentsController@index');
Route::get('department/add', 'DepartmentsController@add');
Route::get('department/{department}/show', 'DepartmentsController@show');
Route::post('department/add', 'DepartmentsController@store');
Route::get('department/getDepartment/{id}', 'Controller@getDepartment');
Route::patch('department/{department}', 'DepartmentsController@update');
Route::delete('department/{department}','DepartmentsController@destroy');

Route::get('section', 'SectionsController@index');
Route::get('section/add', 'SectionsController@add');
Route::get('section/articles/{id}', 'Controller@articles');
Route::post('section/add', 'SectionsController@store');
Route::get('section/getSection/{id}', 'Controller@getSection');
Route::patch('section/{section}', 'SectionsController@update');
Route::delete('section/{section}', 'SectionsController@destroy');

Route::get('article', 'ArticlesController@index');
Route::get('article/add', 'ArticlesController@add');
Route::get('article/sections/{id}', 'Controller@sections');
Route::post('article/add', 'ArticlesController@store');
Route::get('article/getArticle/{id}', 'Controller@getArticle');
Route::patch('article/{article}', 'ArticlesController@update');
Route::delete('article/{article}', 'ArticlesController@destroy');

Route::get('user', 'UsersController@index');
Route::get('user/add', 'UsersController@add');
Route::post('user/add', 'UsersController@store');
Route::get('user/getUser/{id}', 'Controller@getUser');
Route::patch('user/{user}', 'UsersController@update');
Route::delete('user/{user}', 'UsersController@destroy');

Route::get('request', 'ArticleRequestsController@index');
Route::post('request/add', 'ArticleRequestsController@store');
Route::get('request/getArticleRequest/{id}', 'Controller@getArticleRequest');
Route::patch('request/{articleRequest}', 'ArticleRequestsController@update');
Route::delete('request/{articleRequest}', 'ArticleRequestsController@destroy');