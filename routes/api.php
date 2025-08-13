<?php

use App\Http\Controllers\Project\UsersController;
use Illuminate\Support\Facades\Route;
use \App\Http\Controllers\Project\UserController;

// Create User
Route::post('/users/create-user', [UsersController::class, 'store']);

//Retry Create User
Route::get('{uuid}/users/retry', [UsersController::class, 'retry']);

//Resource Users
Route::resource('/users', \App\Http\Controllers\Project\UserController::class);
