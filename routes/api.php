<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Task\ProductController;

//CRUD Products
Route::group(['prefix' => 'products'], function () {
    //get all products
    Route::get('all', [ProductController::class, 'getAllProducts']);
    //get a product by product_id
    Route::get('{product_id}', [ProductController::class, 'getProduct']);
    //create product
    Route::post('create', [ProductController::class, 'createProduct']);
    //update product
    Route::post('{product_id}/update', [ProductController::class, 'updateProduct']);
    //delete product
    Route::post('{product_id}/delete', [ProductController::class, 'deleteProduct']);
});
