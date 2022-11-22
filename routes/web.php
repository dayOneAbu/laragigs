<?php

use App\Http\Controllers\ListingsController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
// get all items in db
Route::get('/', [ListingsController::class, 'index']);
// get the form for creating newItem
Route::get('/listings/create', [ListingsController::class, 'create'])->name('/listings/create')->middleware('auth');
// store the new created Item into db
Route::post('/listings', [ListingsController::class, 'store'])->name('/listings')->middleware('auth');
// manage listings
Route::get('/listings/manage', [ListingsController::class, 'manage'])->name('manage')->middleware('auth');
// get edit form
Route::get('/listings/{listing}/edit', [ListingsController::class, 'edit'])->name('/listings/{listing}/edit')->middleware('auth');
// handles edits request an item(job post)
Route::put('/listings/{listing}', [ListingsController::class, 'update'])->middleware('auth');
// handles delete request an item(job post)
Route::delete('/listings/{listing}', [ListingsController::class, 'destroy'])->middleware('auth');
// gets single item from db
Route::get('/listings/{listing}', [ListingsController::class, 'show'])->name('/listings/{listing}');

// shows registration form
Route::get('/register', [UserController::class, 'create'])->name('register')->middleware('guest');
// shows registration form
Route::post('/users', [UserController::class, 'store'])->middleware('guest');
// shows registration form
Route::post('/logout', [UserController::class, 'logout'])->middleware('auth');
// shows login form
Route::get('/login', [UserController::class, 'login'])->name('login')->middleware('guest');
// authenticate
Route::post('/users/login', [UserController::class, 'authenticate'])->name('/users/login')->middleware('guest');
