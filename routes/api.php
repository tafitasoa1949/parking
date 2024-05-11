<?php

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


Route::resource('parkings', App\Http\Controllers\API\parkingAPIController::class)
    ->except(['create', 'edit']);

Route::resource('tarifs', App\Http\Controllers\API\tarifAPIController::class)
    ->except(['create', 'edit']);

Route::resource('marques', App\Http\Controllers\API\marqueAPIController::class)
    ->except(['create', 'edit']);

Route::resource('voitures', App\Http\Controllers\API\voitureAPIController::class)
    ->except(['create', 'edit']);

Route::resource('etats', App\Http\Controllers\API\etatAPIController::class)
    ->except(['create', 'edit']);

Route::resource('cruds', App\Http\Controllers\API\CrudAPIController::class)
    ->except(['create', 'edit']);

Route::resource('personnes', App\Http\Controllers\API\PersonneAPIController::class)
    ->except(['create', 'edit']);