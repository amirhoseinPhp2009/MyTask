<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\QuestionCard\UsersController;
use App\Http\Controllers\QuestionCard\QuestionCardsController;
use App\Http\Controllers\QuestionCard\UsersProgressController;

//CRUD users
Route::group(['prefix' => 'users'], function () {
    Route::get('{id}', [UsersController::class, 'getUser']);
    Route::post('create', [UsersController::class, 'createUser']);
    Route::post('update/{id}', [UsersController::class, 'updateUser']);
    Route::post('delete/{id}', [UsersController::class, 'deleteUser']);
});

//CRUD questionCards
Route::group(['prefix' => 'question-cards'], function () {
    Route::get('{id}', [QuestionCardsController::class, 'getQuestionCard']);
    Route::post('create', [QuestionCardsController::class, 'createQuestionCard']);
    Route::post('update/{id}', [QuestionCardsController::class, 'updateQuestionCard']);
    Route::post('delete/{id}', [QuestionCardsController::class, 'deleteQuestionCard']);
});

//CRUD user-progress
Route::group(['prefix' => 'user-progress'], function () {
    Route::get('{id}', [UsersProgressController::class, 'getUserProgress']);
    Route::post('create', [UsersProgressController::class, 'createQuestionCard']);
    Route::post('update/{id}', [UsersProgressController::class, 'updateQuestionCard']);
    Route::post('delete/{id}', [UsersProgressController::class, 'deleteQuestionCard']);
    Route::get('my-cards/{user_id}', [UsersProgressController::class, 'getTodayQuestionCard']);
    Route::post('my-cards/send-answer', [UsersProgressController::class, 'checkAnswerUserAndUpdateUserProgress']);
});
