<?php

use App\Http\Controllers\Auth\ForgotPasswordController;
use App\Http\Controllers\Auth\ResetPasswordController;
use App\Http\Controllers\SubscriptionController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Artisan;

Route::get('/', function () {
    return redirect()->route('login');
});

Route::get('storage', function () {
    Artisan::call('storage:link');
});

Route::get('password/forget', [ForgotPasswordController::class, 'forget'])->name('passwords.forget');
Route::post('password/forget', [ResetPasswordController::class, 'reset'])->name('passwords.reset');
Auth::routes();



Route::middleware(['auth'])->group(function () {
    // Generic routes
    Route::get('profile', [UserController::class, 'profile'])->name('profile');
    Route::post('profile', [UserController::class, 'updateProfile'])->name('profile.update');
    Route::post('profile/image', [UserController::class, 'profileImage'])->name('profile.image');
    Route::post('profile/password', [UserController::class, 'Password'])->name('profile.password');

    // subscription routes
    Route::get('subscription', [SubscriptionController::class, 'index'])->name('subscription');
    Route::post('subscription', [SubscriptionController::class, 'subscription'])->name('subscription.save');

    // User Routes
    require base_path() . '/routes/user.php';

    // Admin Routes
    require base_path() . '/routes/admin.php';
});
