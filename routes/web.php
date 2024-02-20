<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController as UserController;

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

// Route::get('/', function () {
//     return view('welcome');
// });

Route::get('/crud', [UserController::class, 'index'])->name('index');

// public access
Route::get('/', function () {
    return redirect()->route('index');
})->name('home');
