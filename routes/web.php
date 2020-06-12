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
// use App\Image;

Route::get('/', function () {

/*    $images = Image::all();
    foreach($images as $image){
        echo $image->description." ".$image->user->surname." - ";
    echo "Likes: ".count($image->likes)."<br> <hr>";

    }

    die();
*/
    return view('welcome');
});

Auth::routes();

Route::get('/', 'HomeController@index')->name('home');
Route::get('/user/config', 'UserController@config')->name('user.config');
Route::post('/user/update', 'UserController@update')->name('user.update');
Route::get('/user/avatar/{filename}', 'UserController@getImage')->name('user.avatar');
Route::get('/image/create', 'ImageController@createImg')->name('image.create');
Route::post('/image/saveImg', 'ImageController@saveImg')->name('image.save');
Route::get('/image/public/{filename}', 'ImageController@getImage')->name('image.public');
Route::get('/image/detail/{id}', 'ImageController@detail')->name('image.detail');
Route::post('/comment/save', 'CommentController@saveComment')->name('comment.save');
Route::get('/comment/delete/{id}', 'CommentController@deleteComment')->name('comment.delete');
Route::get('/like/{image_id}', 'LikeController@like')->name('like.save');
Route::get('/dislike/{image_id}', 'LikeController@dislike')->name('like.delete');
Route::get('/user/profile/{user_id}', 'UserController@profile')->name('user.profile');

