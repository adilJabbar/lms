<?php

use App\Http\Controllers\Admin\StudentController;
use Illuminate\Support\Facades\Route;

/*
  |--------------------------------------------------------------------------
  | Admin Routes
  |--------------------------------------------------------------------------
 */

Route::prefix('admin')->group(static function () {

    // Guest routes
    Route::middleware('guest:admin')->group(static function () {
        // Auth routes

        Route::get('login', [\App\Http\Controllers\Admin\Auth\AuthenticatedSessionController::class, 'create'])->name('admin.login');
        Route::post('login', [\App\Http\Controllers\Admin\Auth\AuthenticatedSessionController::class, 'store']);
        // Forgot password
        Route::get('forgot-password', [\App\Http\Controllers\Admin\Auth\PasswordResetLinkController::class, 'create'])->name('admin.password.request');
        Route::post('forgot-password', [\App\Http\Controllers\Admin\Auth\PasswordResetLinkController::class, 'store'])->name('admin.password.email');
        // Reset password
        Route::get('reset-password/{token}', [\App\Http\Controllers\Admin\Auth\NewPasswordController::class, 'create'])->name('admin.password.reset');
        Route::post('reset-password', [\App\Http\Controllers\Admin\Auth\NewPasswordController::class, 'store'])->name('admin.password.update');

        Route::get('/customer-detail', [CustomerController::class, 'detail'])->name('customer-detail');
        Route::get('/customer-status', [CustomerController::class, 'customerStatus'])->name('customer-status');

        Route::get('/customers/{type?}', [CustomerController::class, 'index'])->name('customers.index');
        // Route::get('/customers/{type?}', [CustomerController::class, 'index'])->name('customers.index');
        Route::get('/customer/{uuid}/edit', [CustomerController::class, 'edit'])->name('customer.edit');
        Route::post('/customer/{uuid}/update', [CustomerController::class, 'update'])->name('customer.update');
        Route::get('/logout', [UserController::class, 'adminLogout'])->name('admin-logout');
        Route::get('/dashboard', [UserController::class, 'dashboard'])->name('admin.dashboard');
    });

    // Verify email routes
    Route::middleware(['auth:admin'])->group(static function () {
        Route::get('verify-email', [\App\Http\Controllers\Admin\Auth\EmailVerificationPromptController::class, '__invoke'])->name('admin.verification.notice');
        Route::get('verify-email/{id}/{hash}', [\App\Http\Controllers\Admin\Auth\VerifyEmailController::class, '__invoke'])->middleware(['signed', 'throttle:6,1'])->name('admin.verification.verify');
        Route::post('email/verification-notification', [\App\Http\Controllers\Admin\Auth\EmailVerificationNotificationController::class, 'store'])->middleware('throttle:6,1')->name('admin.verification.send');
    });

    // Authenticated routes
    Route::middleware(['auth:admin', 'verified'])->group(static function () {
        // Confirm password routes
        Route::get('confirm-password', [\App\Http\Controllers\Admin\Auth\ConfirmablePasswordController::class, 'show'])->name('admin.password.confirm');
        Route::post('confirm-password', [\App\Http\Controllers\Admin\Auth\ConfirmablePasswordController::class, 'store']);
        // Logout route
        Route::post('logout', [\App\Http\Controllers\Admin\Auth\AuthenticatedSessionController::class, 'destroy'])->name('admin.logout');
        // General routes
        Route::get('/', [\App\Http\Controllers\Admin\HomeController::class, 'index'])->name('admin.index');
        Route::get('profile', [\App\Http\Controllers\Admin\HomeController::class, 'profile'])->middleware('password.confirm.admin')->name('admin.profile');
        Route::get('/students/', [\App\Http\Controllers\Admin\StudentController::class, 'index'])->name('students.index');
        Route::get('/subscriptions/', [\App\Http\Controllers\Admin\SubscriptionController::class, 'getList'])->name('subscription.list');
        Route::get('/add-subscription/', [\App\Http\Controllers\Admin\SubscriptionController::class, 'getSubscriptionView'])->name('subscription.add');
        Route::post('/save-subscription/', [\App\Http\Controllers\Admin\SubscriptionController::class, 'saveSubscription'])->name('saveSubscription');
        Route::get('/edit-subscription/{id}', [\App\Http\Controllers\Admin\SubscriptionController::class, 'editSubscription'])->name('subscription.edit');
        Route::post('/updatesubscription/', [\App\Http\Controllers\Admin\SubscriptionController::class, 'updateSubscription'])->name('updateSubscription');
    });
});

