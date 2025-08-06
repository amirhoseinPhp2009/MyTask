<?php

use App\Http\Controllers\Project\UsersController;
use Illuminate\Support\Facades\Route;

// Create User
Route::post('/users/create-user', [UsersController::class, 'store']);

//Retry Create User
Route::get('{uuid}/users/retry', [UsersController::class, 'retry']);

Route::get('/m', [\App\Http\Controllers\Project\BaseController::class, 'index']);
