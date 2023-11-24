<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;

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

/*
|--------------------------------------------------------------------------
| README
|--------------------------------------------------------------------------
|
| The routes are placed in the order the "student" users are expected to use them.
| The first route is the login page, the second is the registration page.
| The third and fourth route are for logging in and signing up.
| After that the routes will come to be redirected to the dashboard,
| And other pages later down as well. It's just good to note that in some ways,
| this code is structured even if it's just a routes file.
|
| DONT FORGET TO ADD THE LINE BELOW FOR PAGES WHERE USER AUTH IS REQUIRED!
| ->middleware('userAuthStatus')
|
*/



// Get requests for the login and registration startup pages
Route::get('/', [AuthController::class, 'login']);              # <------ Login page
Route::get('/register', [AuthController::class, 'registration']);               # <------ Sign up page
Route::get('/logout', [AuthController::class, 'logoutUser']);

// Post requests for signing up and logging in
Route::post('/register-user', [AuthController::class, 'accountRegistration'])->name('register-user');               # <------ Will user go to after clicking on the button to register
Route::post('/login-user', [AuthController::class, 'loginUser'])->name('login-user');               # <------ Will user go to after clicking the login button

// Send user to dashboard
Route::get('dashboard', [AuthController::class, 'dashboard'])->middleware('userAuthStatus');              # <------ Send the user to their dashboard
