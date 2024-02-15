<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\EventController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\InvitationController;
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
Route::get('/editor/{id}', [NavigationController::class, 'goToEditor']);
Route::get('/editor', [NavigationController::class, 'goToEditor']);


//Starting from a url of a certain event
Route::get('/{slug}', [NavigationController::class, 'show']);
Route::post('/{slug}/rsvp', [InvitationController::class, 'rsvp']);

//view
Route::post('/view-event', [NavigationController::class, 'viewEvent']);
 
//login system
Route::post('/login/{slug?}', [UserController::class, 'login']);
Route::post('/register/{slug?}', [UserController::class, 'register']);
Route::post('/logout', [UserController::class, 'logout']);
Route::delete('/delete', [UserController::class, 'deleteAccount']);

//create an event
Route::post('/create', [EventController::class, 'createEvent']);
Route::delete('/delete/{id}', [EventController::class, 'deleteEvent']);

