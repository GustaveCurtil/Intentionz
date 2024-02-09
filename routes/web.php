<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\EventController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\NavigationController;

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

Route::get('/', [NavigationController::class, 'show']);


//Starting from a url of a certain event
Route::get('/{slug}', [NavigationController::class, 'show']);
Route::post('/{slug}/login', [UserController::class, 'login']);
Route::post('/{slug}/register', [UserController::class, 'register']);

//view
Route::post('/view-event', [NavigationController::class, 'viewEvent']);
 
//login system
Route::post('/login', [UserController::class, 'login']);
Route::post('/register', [UserController::class, 'register']);
Route::post('/logout', [UserController::class, 'logout']);
Route::delete('/delete', [UserController::class, 'deleteAccount']);

//create an event
Route::post('/create', [EventController::class, 'createEvent']);


//Interaction with other users
Route::post('/add-contact', [ContactController::class, 'addContact']);
Route::post('/invite/{id}', [ContactController::class, 'inviteContacts']);
Route::post('/going/{id}', [ContactController::class, 'going']);