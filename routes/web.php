<?php
use App\Http\Controllers\TaskController;
use App\Http\Controllers\SignInController;
use App\Http\Controllers\SignUpController;
use Illuminate\Support\Facades\Route;

Route::get('/signin', function () {
    return view('signin');
})->name('login');
Route::post('/signin', [SignInController::class, 'create'])->name('login');

Route::get('/signup', function (){
    return view('signup');
})->name('signup');
Route::post('/signup', [SignUpController::class, 'signup'])->name('signup');

route::get('/tasks/get', [TaskController::class, 'getAllTasksByUserId']);

Route::get('/home', function(){
    return view('home');
})->name('home')->middleware('auth');
Route::post('/home', [TaskController::class, 'store'])->middleware('auth')->name('task_register');