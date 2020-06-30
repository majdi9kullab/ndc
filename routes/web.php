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
Route::get('/index', function () {
    return view('admin.layout.app');
});

Route::get("/country/all","CountryController@index");
Route::get("/country/create","CountryController@create")->name('create_new_country');
Route::post("/country/postcreate","CountryController@postcreate")->name('post-create-country');


Route::get("/country/delete/{id}","CountryController@delete")->name('delete-country');
Route::get("/country/update/{id}","CountryController@Update")->name('Update-country');
Route::post("/country/update/{id}","CountryController@postupdate")->name('post-Update-country');

Route::resource('city', 'CityController');
Route::get("/city/{id}/delete","CityController@destroy")->name('delete-city');

Route::get("/news/search","NewsController@search")->name('search-news');
Route::get("/news/search-paging","NewsController@searchPaging")->name('search-paging-news');

Route::get("/news/paging","NewsController@paging")->name('paging-news');
Route::get("/news/advance-search","NewsController@AdvanceSearch")->name('advance-search-news');
Route::get("/category/paging","CategoryController@paging")->name('paging-categories');
Route::get("/category/search","CategoryController@search")->name('search-categories');
Route::get("/category/search-paging","CategoryController@SearchPaging")->name('search-categories-paging');

Route::resource("category", "CategoryController");
Route::resource("news", "NewsController");

