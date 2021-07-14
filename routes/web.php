<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\InfoController as UserInfo;
use App\Http\Controllers\ProfileController as ProfileController;
use App\Http\Controllers\PostController as PostController;
use App\Http\Controllers\LoggedOut as LoggedOut;
use App\Http\Controllers\MessagesController as MessagesController;
use App\Http\Controllers\GetComments as GetComments;
use App\Http\Controllers\RecentComments as RecentComments;
use App\Http\Controllers\ListCaches as ListCaches;

Route::get('/', function () {
    return view('auth.login');
});

Route::get('/profile' , [ProfileController::class, 'returnProfile'])->name('profile');

Route::get('/view-post' , [PostController::class, 'returnPost'])->name('view-post');

Route::get('/messages' , [MessagesController::class, 'returnMessageInterface'])->name('messages')->middleware('auth');

Route::get('/get-comments' , [GetComments::class, 'returnCommentsView'])->name('view-comments')->middleware('auth');

Route::get('/recent-comments' , [RecentComments::class, 'getRecentComments'])->name('recent-comments')->middleware('auth');

Route::get('/list-caches' , [ListCaches::class, 'getCaches'])->name('list-caches');

Route::post('/user_info' , [UserInfo::class , 'returnInfo']);

Route::post('/logged-out' , [LoggedOut::class, 'changeActiveStatus']);

Route::middleware(['auth:sanctum', 'verified'])->get('/home', function () {
    return view('home');
})->name('home');

Route::middleware(['auth:sanctum', 'verified'])->get('/posts', function () {
    return view('posts');
})->name('posts');


Route::middleware(['auth:sanctum', 'verified'])->get('/search', function () {
    return view('search');
})->name('search');

Route::middleware(['auth:sanctum', 'verified'])->get('/inbox', function () {
    return view('inbox');
})->name('inbox');

Route::middleware(['auth:sanctum', 'verified'])->get('/requests', function () {
    return view('requests');
})->name('requests');

Route::middleware(['auth:sanctum', 'verified'])->get('/connections', function () {
    return view('connections');
})->name('connections');


