<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MessageController;

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
    // return view('welcome');
    return view('home');
});
Route::get('/camera/scanners', [MessageController::class, 'scanner'])->name('camera.scanners');
Route::get('/camera/cctv', [MessageController::class, 'cctv'])->name('camera.cctv');
