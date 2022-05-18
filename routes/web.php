<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CustomAuthController;
use Illuminate\Support\Facades\Request;
use App\Http\Controllers\Controller;
use App\Http\Controllers\ForgotPasswordController;
use App\Http\Controllers\contactController;


Route::get('/', function () {
    return view('home');
});

Route::get('/login', [CustomAuthController::class, 'login'])->middleware('alreadyLoggedIn');
Route::get('/registration', [CustomAuthController::class, 'registration'])->middleware('alreadyLoggedIn');
Route::post('/register-user', [CustomAuthController::class, 'registerUser'])->name('register-user');
Route::post('/login-user', [CustomAuthController::class, 'loginUser'])->name('login-user');
Route::get('/dashboard', [CustomAuthController::class, 'dashboard']);
Route::get('/logout', [CustomAuthController::class, 'logout']);
Route::get('/search', [CustomAuthController::class, 'search'])->name('search');


Route::get('forget-password', [ForgotPasswordController::class, 'ForgetPassword'])->name('ForgetPasswordGet');
Route::post('forget-password', [ForgotPasswordController::class, 'ForgetPasswordStore'])->name('ForgetPasswordPost');
Route::get('reset-password/{token}', [ForgotPasswordController::class, 'ResetPassword'])->name('ResetPasswordGet');
Route::post('reset-password', [ForgotPasswordController::class, 'ResetPasswordStore'])->name('ResetPasswordPost');


Route::get('/question/{id}/{slug}', [CustomAuthController::class, 'question'])->name('question');   
Route::get('/getUserNameById/{id}', [CustomAuthController::class, 'getUserNameById']);
Route::get('/unAnswered', [CustomAuthController::class, 'unAnswered'])->name('unAnswered');
Route::get('/autocomplete-search', [CustomAuthController::class, 'autocompleteSearch'])->name('autocompleteSearch');

// Route::get('/profile', function () {
//     return view('profile');
// });

Route::get('/editProfile', function () {
    return view('editProfile');
});

Route::post('/data', [CustomAuthController::class, 'AddQuestion'])->name('data');
Route::post('/addAns', [CustomAuthController::class, 'AddAnswer'])->name('addAns');
Route::get('/showUserProfile/{id?}', [CustomAuthController::class, 'showUserProfile'])->name('showUserProfile');

Route::post('/profile/data', [CustomAuthController::class, 'profileUpdate'])->name('pData');
Route::get('/profile', [CustomAuthController::class, 'profile']);
Route::get('/editProfile', [CustomAuthController::class, 'editProfile']);

Route::get('/contact',[contactController::class,'contact']);
Route::post('/send-message',[contactController::class,'sendEmail'])->name('contact.send');

Route::POST('/addComment', [CustomAuthController::class, 'addComment']);




Route::fallback(function(){
    return view('error');
});