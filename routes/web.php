<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\MemberController;
use App\Http\Controllers\StaffController;

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
    return view('home');
});
Route::get('home', function () {
    return view('home');
});

Route::middleware(['guest'])->group(function() {
    // Authentication
    Route::get('register',[RegisterController::class, 'index']);
    Route::get('login', [LoginController::class, 'index'])->name('login');
    Route::post('login', [LoginController::class, 'authenticate']);
    Route::post('register', [RegisterController::class, 'registerUser'])->name('register');
});

// Logout for all users role
Route::get('logout', [UserController::class, 'logout']);


// Admins routes
Route::middleware(['auth', 'user-access:admin'])->prefix('admin')->group(function () {
    Route::get('dashboard', [AdminController::class, 'home']);
    Route::get('account-settings', [AdminController::class, 'accountSettings']);
    Route::get('change-password', [AdminController::class, 'changePassword']);
    Route::put('profile-update', [AdminController::class, 'updateProfile']);
    Route::post('change-password', [AdminController::class, 'updatePassword']);
    
    // Users records
    Route::get('users-records/{role}', [AdminController::class, 'usersRecords']);

    // Status update
    Route::post('status-update', [AdminController::class, 'updateStatus'])->name('update-status');

    // View
    Route::get('view-profile/{user}', [AdminController::class, 'viewProfile']);

    // Delete user 
    Route::post('delete-user/{user}', [AdminController::class, 'deleteUser']);
});

// Staff routes
Route::middleware(['auth', 'user-access:staff'])->prefix('staff')->group(function () {
    Route::get('dashboard', [StaffController::class, 'home']);
    Route::get('profile', [StaffController::class, 'profile']);
});

// Members routes
Route::middleware(['auth', 'user-access:member'])->prefix('member')->group(function () {
    Route::get('dashboard', [MemberController::class, 'home']);
});





