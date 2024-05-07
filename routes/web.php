<?php

use App\Http\Controllers\AuthController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', [AuthController::class,'index'])->name('login');
Route::post('/logout', [AuthController::class,'deconnexion'])->name('logout');
Route::post('/login', [AuthController::class,'se_login'])->name('se_login');
Route::get('/registre', [AuthController::class,'registre'])->name('registre');
Route::post('/inscription', [AuthController::class,'inscription'])->name('inscription');

Route::middleware('auth')->group(function (){
    Route::resource('parkings', App\Http\Controllers\parkingController::class);
    Route::get('enstation/{id}', [App\Http\Controllers\ParkingController::class, 'enstation'])->name('enstation');
    Route::post('stationner', [App\Http\Controllers\ParkingController::class, 'stationner'])->name('stationner');
    Route::get('stationnement', [App\Http\Controllers\ParkingController::class, 'stationnement'])->name('stationnement');
    Route::post('sortie', [App\Http\Controllers\ParkingController::class, 'sortie'])->name('sortie');
    Route::get('facturer/{id}', [App\Http\Controllers\ParkingController::class, 'facturer'])->name('facturer');

    Route::resource('tarifs', App\Http\Controllers\tarifController::class);

    Route::resource('marques', App\Http\Controllers\marqueController::class);

    Route::resource('voitures', App\Http\Controllers\voitureController::class);
});



