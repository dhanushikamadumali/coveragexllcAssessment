<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TaskController;

Route::post('storeTask',[TaskController::class, 'store']);
Route::get('allTask',[TaskController::class, 'index']);
Route::put('updateStatus/{task}',[TaskController::class, 'updateStatus']);
