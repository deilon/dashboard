<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\MemberController;
use App\Http\Controllers\StaffController;
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\SubscriptionArrangementController;
use App\Http\Controllers\SubscriptionTierController;
use App\Http\Controllers\SubscriptionController;
use App\Http\Controllers\AnnouncementsPromotionsController;
use App\Http\Controllers\FrontController;
use App\Http\Controllers\SalesRevenueController;

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

Route::get('/', [FrontController::class, 'index']);
Route::get('home', [FrontController::class, 'index']);
Route::get('announcements', [FrontController::class, 'announcementsPromotions']);
Route::get('logout', [AuthController::class, 'logout']);

Route::middleware(['guest'])->group(function() {
    // Authentication
    Route::get('register',[AuthController::class, 'register']);
    Route::get('login', [AuthController::class, 'login'])->name('login');
    Route::post('login', [AuthController::class, 'authenticate']);
    Route::post('register', [AuthController::class, 'registerMember'])->name('register');
});

// ========= USERS ROUTES =========
Route::middleware(['auth'])->prefix('user')->group(function() {
    Route::get('account-settings', [UserController::class, 'accountSettingsView']);
    Route::get('change-password', [UserController::class, 'changePasswordView']);

    // All users
    Route::put('profile-update', [UserController::class, 'updateAccount']);
    Route::post('change-password', [UserController::class, 'updatePassword']);

});

// ========= ADMIN ROUTES =========
Route::middleware(['auth', 'user-access:admin'])->prefix('admin')->group(function () {
    // ADMIN DASHBOARD
    Route::get('dashboard', [AdminController::class, 'home']);

    // SALES REVENUE VIEW
    Route::get('sales/month', [SalesRevenueController::class, 'getCurrentMonth']);
    Route::get('sales/today', [SalesRevenueController::class, 'getTodaySales']);
    Route::get('sales/all', [SalesRevenueController::class, 'getAllSales']);
    Route::get('/sales/search', [SalesRevenueController::class, 'search'])->name('sales.search');

    // SALES REVENUE EXPORT 
    Route::get('sales/export/this/month', [SalesRevenueController::class, 'salesExportCurrentMonth'])->name('sales.this.month');
    Route::get('sales/export/today', [SalesRevenueController::class, 'salesExportToday'])->name('sales.today');
    Route::get('sales/export/all', [SalesRevenueController::class, 'export'])->name('sales.export');
});

// ========= STAFF ROUTES =========
Route::middleware(['auth', 'user-access:staff'])->prefix('staff')->group(function () {
    Route::get('dashboard', [StaffController::class, 'home']);
    Route::get('profile', [StaffController::class, 'profile']);
});

// MANAGEMENT ROUTES
Route::middleware(['auth', 'multi-role:admin,staff'])->prefix('management')->group(function() {

    // USERS RECORDS
    Route::get('users-records/{role}', [UserController::class, 'usersRecords']);
    Route::get('records/{role}', [UserController::class, 'adminRecords']);
    Route::get('subscribers', [SubscriptionController::class, 'subscribers']);
    Route::post('status-update', [UserController::class, 'updateStatus'])->name('update-status');

    // STAFF MANAGE
    Route::get('users/{role}', [StaffController::class, 'staffRecords']);
    Route::post('create/staff', [StaffController::class, 'createStaff'])->name('create.staff');
    Route::post('update/staff', [StaffController::class, 'updateStaff'])->name('update.staff');
    
    // MANAGE GYM SUBSCRIBERS
    Route::post('update-subscription-status', [SubscriptionController::class, 'updateSubscriptionStatus'])->name('update-sub-status');
    Route::post('update-subscription-trainer', [SubscriptionController::class, 'updateSubscriptionTrainer'])->name('update-trainer');
    Route::post('remove-trainer', [AdminController::class, 'removeTrainer'])->name('remove-trainer');
    Route::get('view-subscription/{subscriber_id}', [SubscriptionController::class, 'viewSubscription']);
    Route::post('delete-subscription/{subscription_id}', [SubscriptionController::class, 'deleteSubscription']);

    // VIEW PROFILE
    Route::get('view-profile/{user}', [UserController::class, 'viewProfile']);

    // DELETE USER 
    Route::post('delete-user/{user}', [AdminController::class, 'deleteUser']);

    // SUBSCRIPTION ARRANGEMENTS
    Route::get('subscription-arrangements', [SubscriptionArrangementController::class, 'subscriptionArrangements']);
    Route::post('update-arrangement-status', [SubscriptionArrangementController::class, 'toggleArrangementStatus'])->name('toggleArrStatus');
    Route::post('update-arrangement-countdown', [SubscriptionArrangementController::class, 'toggleArrangementCountdown'])->name('toggleArrCountdown');
    Route::post('add-arrangement', [SubscriptionArrangementController::class, 'addArrangement'])->name('addArrangement');
    Route::post('update-arrangement', [SubscriptionArrangementController::class, 'updateArrangement'])->name('updateArrangement');
    Route::post('delete-arrangement/{arrangement_id}', [SubscriptionArrangementController::class, 'deleteSubscriptionArrangement'])->name('delete.arrangement');

    // SUBSCRIPTION PACKAGES / TIERS
    Route::get('packages/sub-plan/{sub_plan_id}', [SubscriptionTierController::class, 'index']);
    Route::post('package/create', [SubscriptionTierController::class, 'create'])->name('create.package');
    Route::post('package/update', [SubscriptionTierController::class, 'update'])->name('update.package');
    Route::post('package/delete/{package_id}', [SubscriptionTierController::class, 'delete'])->name('delete.package');

    // ANNOUNCEMENTS AND PROMOTIONS
    Route::get('announcements-promotions', [AnnouncementsPromotionsController::class, 'index']);
    Route::post('announcements-promotions', [AnnouncementsPromotionsController::class, 'create'])->name('create.ap');
    Route::post('update-ap', [AnnouncementsPromotionsController::class, 'update'])->name('update.ap');
    Route::post('delete-ap/{ap_id}', [AnnouncementsPromotionsController::class, 'delete'])->name('delete.ap');
});

// ========= MEMBERS ROUTES =========
Route::middleware(['auth', 'user-access:member'])->prefix('member')->group(function () {
    // Members Dashboard
    Route::get('dashboard', [MemberController::class, 'home']);
    
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





