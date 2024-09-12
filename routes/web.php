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

Route::get('/home', [TaskController::class, 'index'])->name('home')->middleware('auth');
Route::post('/home', [TaskController::class, 'store'])->middleware('auth')->name('task_register');

Route::delete('/task/{id}', [TaskController::class, 'destroy'])->middleware('auth')->name('tasks.destroy');
Route::delete('/tasks/delete-all', [TaskController::class, 'destroyAll'])->middleware('auth')->name('tasks.destroyAll');

Route::put('/tasks/{id}', [TaskController::class, 'update'])->middleware('auth')->name('tasks.update');