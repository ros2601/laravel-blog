<?php
 
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CustomAuthController;
 
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
// Route::get('/', [CustomAuthController::class, 'home']); 
Route::get('dashboard', [CustomAuthController::class, 'dashboard']); 
Route::get('login', [CustomAuthController::class, 'index'])->name('login');
Route::post('postlogin', [CustomAuthController::class, 'login'])->name('postlogin'); 
Route::get('signup', [CustomAuthController::class, 'signup'])->name('register-user');
Route::post('postsignup', [CustomAuthController::class, 'signupsave'])->name('postsignup'); 
Route::get('signout', [CustomAuthController::class, 'signOut'])->name('signout');
Route::post('/upload1',"App\Http\Controllers\CustomAuthController@upload");
Route::get('/home',"App\Http\Controllers\CustomAuthController@products");
Route::get('/detail/{id}',"App\Http\Controllers\CustomAuthController@detail");
Route::post('/comm/{id}',"App\Http\Controllers\CustomAuthController@comments");
Route::post('/contact1',"App\Http\Controllers\CustomAuthController@contact");
Route::get('/user',"App\Http\Controllers\CustomAuthController@user");