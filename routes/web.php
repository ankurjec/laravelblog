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

// Route::get('/', function () {
//     return view('auth.login');
// });


// Route::get('/public', function () {
//     return view('public.index');
// });

Route::resource('/', 'PublicController');
Route::get('/registery', 'Auth\RegisterController@showRegstrationForm');
Route::get('/register/{id}', 'Auth\RegisterController@showRegistrationForm');

// Route::get('/public',[
//     'uses' => 'PublicController@index',
//     'as' => 'public'
// ]);
Route::group(['middleware' => 'auth'], function(){
    Route::get('/profile/{id}', [
        'uses' => 'ProfileController@index',
        'as'   => 'profile'
    ]);
    Route::post('/addprofile', [
        'uses' => 'ProfileController@addprofile',
        'as'   => 'addprofile'
    ]);
    Route::get('/home',[
        'uses' => 'HomeController@index',
        'as' => 'home'
    ]);

    Route::get('/random-string',[
        'uses' => 'HomeController@generateRandomString',
        'as' => 'random-string'
    ]);
    // Route::get('/random-string', 'HomeController@generateRandomString');
    Route::any('/generate-password', function (Request $request) {
        
        $user = Auth::user();
        $token = Str::random(12); 
        $user->referral_code = ($token);
        $user->save();
        return 'http://127.0.0.1:8000/register/' .$token; 
    });
    Route::post('/save-password', 'HomeController@save');

    Route::get('/newPost', [
        'uses' => 'PostController@newpost',
        'as' => 'newPost'
    ]);
    Route::post('/addPost', [
        'uses' => 'PostController@addpost',
        'as' => 'addPost'
    ]);
    Route::get('/viewPost/{id}',[
        'uses' => 'PostController@viewpost',
        'as' =>'viewPost'
    ]);
    Route::get('/editPost/{id}',[
        'uses' => 'PostController@editpost',
        'as' =>'editPost'
    ]);
    Route::post('/updatePost/{id}',[
        'uses' => 'PostController@updatepost',
        'as' =>'updatePost'
    ]);
    Route::get('/deletePost/{id}',[
        'uses' => 'PostController@deletepost',
        'as' =>'deletePost'
    ]);
    Route::get('/approvePost/{id}',[
        'uses' => 'PostController@approvepost',
        'as' =>'approvePost'
    ]);
    Route::get('/postLikes/{id}',[
        'uses' => 'PostController@postlikes',
        'as'  => 'postLikes'
    ]);
    Route::get('/postDislikes/{id}',[
        'uses' => 'PostController@postdislikes',
        'as'  => 'postDislikes'
    ]);
    Route::post('/addComment/{id}',[
        'uses' => 'PostController@addcomment',
        'as'  => 'addComment'
    ]);
    Route::get('/newCategory', [
        'uses' => 'CategoryController@index',
        'as' => 'newCategory'
    ]);
    Route::post('/addCategory', [
        'uses' => 'CategoryController@addcategory',
        'as' => 'addCategory'
    ]);
    Route::get('/filterCategory/{name}', [
        'uses' => 'CategoryController@filtercategory',
        'as' => 'filterCategory'
    ]);    
});
Auth::routes();

// Route::get('/home', 'HomeController@index')->name('home');

