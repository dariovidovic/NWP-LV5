<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ProfessorController;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\LocalizationController;

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::get('/admin', [UserController::class, 'showUsers'])->name('admin');
Route::get('/thesis/{locale}', [ProfessorController::class, 'addThesis'])->name('locale.switch');

Route::get('/edit/{userId}', [UserController::class, 'editUser'])->name('users.edit');
Route::put('/update/{userId}', [UserController::class, 'updateUserRole'])->name('users.update');
Route::post('/thesis/task', [ProfessorController::class, 'saveTask'])->name('tasks.save');

Route::get('/tasks', [StudentController::class, 'searchTasks'])->name('tasks.search');
Route::get('/tasks/myTasks', [ProfessorController::class, 'myTasks'])->name('tasks.myTasks');
Route::post('/tasks/task', [StudentController::class, 'apply'])->name('tasks.apply');

Route::post('/tasks/{task_id}/choose/{student_id}', [ProfessorController::class, 'chooseStudent'])->name('tasks.choose.student');


