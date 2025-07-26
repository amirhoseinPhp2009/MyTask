<?php

use App\Http\Controllers\Tour\UserController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::middleware(['auth:sanctum'])->get('/user', function (Request $request) {
    return $request->user();
});

//Cancelling Reserves By CountryId Route
//Route::post('/reserve-cancelling-by-country-id/{countryId}', [ReserveController::class, 'reserveCancellingByCountryId']);

Route::any('users/create-user', [UserController::class, 'createUser']);

Route::get('{uuidUserFailed}/failed-create-user', [UserController::class, 'retryCreateUser']);
