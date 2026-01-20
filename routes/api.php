<?php

use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

Route::get('/index', [UserController::class, 'index']);
Route::get('/show/{userId}', [UserController::class, 'index']);
Route::post('/store', [UserController::class, 'index']);
Route::patch('/update/{userId}', [UserController::class, 'index']);
Route::delete('/destroy/{userId}', [UserController::class, 'index']);
