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

Route::get('/','App\Http\Controllers\welcomeController@index');

Auth::routes();

Route::group(['middleware'=>'auth'],function(){

    Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
    Route::resource('/categories','App\Http\Controllers\categoriesController');
    Route::resource('/posts','App\Http\Controllers\postsController');
    Route::resource('/comments','App\Http\Controllers\commentsController'); 
    Route::resource('/tags','App\Http\Controllers\tagsController');
    Route::get('/trashed-posts','App\Http\Controllers\postsController@trashed')->name('trashedPosts.index');
    Route::get('/trashed-posts/{id}','App\Http\Controllers\postsController@restore')->name('trashed.restore');

});

Route::get('/showPost/{id}','App\Http\Controllers\showController@show')->name('show.post');
Route::middleware(['isAdmin','auth'])->group(function(){
    Route::get('/dashbord','App\Http\Controllers\DashbordController@index')->name('dashbord.index'); 
    Route::get('/users','App\Http\Controllers\usersController@index')->name('users.index');
    Route::post('/users/{id}/make-admin','App\Http\Controllers\usersController@make_admin')->name('users.make-admin');
});



Route::middleware(['auth'])->group(function(){
    Route::get('/users/{id}/profile','App\Http\Controllers\usersController@edit')->name('users.profile');
    Route::post('/users/{id}/update','App\Http\Controllers\usersController@update')->name('users.update');

});