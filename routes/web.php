<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\MemberController;
use App\Http\Controllers\StaffController;
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\SubscriptionArrangementController;
use App\Http\Controllers\SubscriptionController;

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
    Route::get('register',[AuthController::class, 'register']);
    Route::get('login', [AuthController::class, 'login'])->name('login');
    Route::post('login', [AuthController::class, 'authenticate']);
    Route::post('register', [AuthController::class, 'registerMember'])->name('register');
});

// Logout for all users role
Route::get('logout', [AuthController::class, 'logout']);


// Admins routes
Route::middleware(['auth', 'user-access:admin'])->prefix('admin')->group(function () {
    Route::get('dashboard', [AdminController::class, 'home']);
    Route::get('account-settings', [AdminController::class, 'accountSettings']);
    Route::get('change-password', [AdminController::class, 'changePassword']);
    Route::put('profile-update', [AdminController::class, 'updateProfile']);
    Route::post('change-password', [AdminController::class, 'updatePassword']);
    
    // Users records
    Route::get('users-records/{role}', [AdminController::class, 'usersRecords']);
    Route::get('subscribers', [AdminController::class, 'subscribers']);

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
    
    Route::get('account-settings', [MemberController::class, 'accountSettings']);
    Route::get('change-password', [MemberController::class, 'changePassword']);
    Route::put('profile-update', [MemberController::class, 'updateProfile']);
    Route::post('change-password', [MemberController::class, 'updatePassword']);
    
    // Non subscriber access only
    Route::middleware(['auth', 'subscriber-access'])->group(function() {
        // Checkout
        Route::get('checkout/plan/{subscription_arrangement_id}/tier_id/{tier_id}', [CheckoutController::class, 'checkoutPage'])->name('checkout.plan');

        // Subscription
        Route::post('subscribe', [SubscriptionController::class, 'subscribe'])->name('subscribe');
    });

    // Availables Subscription Plan & Packages
    Route::get('available-packages', [SubscriptionArrangementController::class, 'index']);

    // Membership details
    Route::get('membership-details', [MemberController::class, 'membershipDetails']);
});





