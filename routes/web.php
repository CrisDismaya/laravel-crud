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
Route::get('/crud/show', [UserController::class, 'show'])->name('show');
Route::post('/crud/create', [UserController::class, 'create'])->name('create');
Route::patch('/crud/{id}', [UserController::class, 'update'])->name('update');
Route::delete('/crud/{id}', [UserController::class, 'delete'])->name('delete');

// public access
Route::get('/', function () {
    return redirect()->route('index');
})->name('home');
