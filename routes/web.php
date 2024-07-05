<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\TodoListController;
use App\Http\Controllers\TodoCategoryController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::prefix('auth')->group(function () {
    Route::get('/login', [AuthController::class, 'loginPage'])->name('login');
    Route::get('/register', [AuthController::class, 'registerPage'])->name('register');
    Route::post('/register', [AuthController::class, 'register'])->name('register.submit');
    Route::post('/login', [AuthController::class, 'login'])->name('login.submit');
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
});

Route::prefix('todo')->group(function () {
    Route::get('/home', [TodoListController::class, 'index'])->name('todo.home');
    Route::get('/create', [TodoListController::class, 'create'])->name('todo.create');
    Route::post('/store', [TodoListController::class, 'store'])->name('todo.store');
    Route::get('/edit/{id}', [TodoListController::class, 'edit'])->name('todo.edit');
    Route::put('/update/{id}', [TodoListController::class, 'update'])->name('todo.update');
    Route::delete('/destroy/{id}', [TodoListController::class, 'destroy'])->name('todo.destroy');
    Route::post('/update-status/{id}', [TodoListController::class, 'updateStatus'])->name('todo.updateStatus');
});

Route::prefix('category')->group(function () {
    Route::get('/home', [TodoCategoryController::class, 'home'])->name('category.home');
    Route::get('/create', [TodoCategoryController::class, 'create'])->name('category.create');
    Route::post('/store', [TodoCategoryController::class, 'store'])->name('category.store');
    Route::get('/edit/{id}', [TodoCategoryController::class, 'edit'])->name('category.edit');
    Route::post('/update/{id}', [TodoCategoryController::class, 'update'])->name('category.update');
    Route::delete('/destroy/{id}', [TodoCategoryController::class, 'destroy'])->name('category.destroy');
});

Route::prefix('user')->group(function () {
    Route::get('/home', [UserController::class, 'index'])->name('user.home');
    Route::get('/edit/{id}', [UserController::class, 'edit'])->name('user.edit');
    Route::post('/update/{id}', [UserController::class, 'update'])->name('user.update');
    Route::delete('/destroy/{id}', [UserController::class, 'destroy'])->name('user.destroy');
});

