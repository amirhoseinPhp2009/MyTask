<?php

use App\Http\Controllers\Tour\UserController;
use Illuminate\Support\Facades\Route;

//Creating User With Any Request Method .
Route::any('users/create-user', [UserController::class, 'createUser']);

// Retrying the User Failed .
Route::get('{uuid}/retry-create-user', [UserController::class, 'retryCreateUser']);
