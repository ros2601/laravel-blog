<?php
 
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\BlogController;

Route::get('/', function () {
   return view('welcome');
});
Route::get('/head', function () {
   return view('head');
});
Route::get('/home', function () {
   return view('home');
});
Route::get('/upload', function () {
   return view('upload');
});
Route::get('/contact', function () {
   return view('contact');
});

// Route::post('postlogin', [AuthController::class, 'login'])->name('postlogin'); 
Route::get('signup', [AuthController::class, 'signup'])->name('register-user');
Route::get('login', [AuthController::class, 'index'])->name('login');


//----------------------for register form---------------------------------------------------
Route::post('postsignup', [AuthController::class, 'signupsave'])->name('postsignup'); 
//----------------------for login form---------------------------------------------------
Route::post('postsignup', [AuthController::class, 'signupsave'])->name('postsignup'); 
//----------------------for logout---------------------------------------------------
Route::get('signout', [AuthController::class, 'signOut'])->name('signout');

//-----------------for uploading blogs by auth user-------------------------------------
Route::post('/upload1',"App\Http\Controllers\BlogController@upload");
//-------------------shows blogs on home page------------------------------------------
Route::get('/home',"App\Http\Controllers\BlogController@blogs");
//------------------for showing a particular post with details-------------------------
Route::get('/detail/{id}',"App\Http\Controllers\BlogController@detail");
//----------------------for comment---------------------------------------------------
Route::post('/comm/{id}',"App\Http\Controllers\BlogController@comments");
//--------------------for sending a query-------------------------------------------------
Route::post('/contact1',"App\Http\Controllers\BlogController@contact");
//----------------for opening page that shows posts by auth user-----------------------
Route::get('/user',"App\Http\Controllers\BlogController@user");
//---------------------for deleting a post-----------------------------------------------
Route::get('/delete/{id}',"App\Http\Controllers\BlogController@delete");
