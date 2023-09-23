<?php

use App\Http\Controllers\AppController;
use Illuminate\Support\Facades\Route;


Route::get('/', [AppController::class, 'index']);
Route::get('/getSpaces/{workspace_id}', [AppController::class, 'getSpaces']);
Route::get('/getLists/{spaces_id}', [AppController::class, 'getLists']);
Route::get('/getUsers/{list_id}', [AppController::class, 'getUsers']);
Route::post('/addTask', [AppController::class, 'addTask']);



