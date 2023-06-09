<?php

use App\Http\Controllers\CheckListController;
use App\Http\Controllers\CheckListItemController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::controller(CheckListController::class)->group(function() {
    Route::get('/check-lists', 'index');
    Route::post('/check-lists', 'create');
    Route::patch('/check-lists/{id}', 'update');
    Route::get('/check-lists/{id}', 'show');
    Route::delete('/check-lists/{id}', 'delete');
});

Route::controller(CheckListItemController::class)->group(function() {
    Route::post('/check-list-items', 'create');
    Route::patch('/check-list-items/{id}', 'update');
    Route::delete('/check-list-items/{id}', 'delete');
    Route::patch('check-list-items/{id}/finish', 'finish');
    Route::patch('check-list-items/{id}/unfinish', 'unfinish');
});
