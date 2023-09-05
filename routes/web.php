<?php

use App\Http\Controllers\RajaOngkirController;
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

Route::get('/', function () {
    return view('app');
});
Route::get('/rajaOngkir', function () {
    return view('rajaongkir');
});
Route::get('/ShowProvinces', [RajaOngkirController::class, 'ShowProvinces'])->name('rajaOngkir.ShowProvinces');
Route::get('/showOngkir/{id}', [RajaOngkirController::class, 'showOngkir'])->name('rajaOngkir.showOngkir');
Route::get('/getService', [RajaOngkirController::class, 'getService'])->name('rajaOngkir.getService');
