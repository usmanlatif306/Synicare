<?php

use App\Http\Controllers\Admin\AllergyController;
use App\Http\Controllers\Admin\AppointmentController;
use App\Http\Controllers\Admin\MedicationController;
use App\Http\Controllers\Admin\SettingController;
use App\Http\Controllers\Admin\SubscriptionController;
use App\Http\Controllers\Admin\UserController as AdminUserController;
use Illuminate\Support\Facades\Route;


Route::group(['prefix' => 'admin', 'as' => 'admin.', 'middleware' => 'admin'], function () {
    Route::get('dashboard', [SettingController::class, 'dashboard'])->name('dashboard');
    Route::post('users/{user}profile', [AdminUserController::class, 'updateImage'])->name('users.image');

    // admin users routes
    Route::resource('users', AdminUserController::class);

    // admin allergies routes
    Route::resource('allergies', AllergyController::class);

    // admin medications routes
    Route::get('medications/{medication}/show', [MedicationController::class, 'medicationShow'])->name('medications.view');
    Route::resource('medications', MedicationController::class);

    // admin appointments routes
    Route::resource('appointments', AppointmentController::class);



    // user subscriptions
    Route::view('subscriptions', 'admin.subscriptions.index')->name('subscription');

    // settings
    Route::get('/settings', [SettingController::class, 'index'])->name('settings');
    Route::post('/settings/general', [SettingController::class, 'updateGeneral'])->name('settings.general');
    Route::post('/settings/email', [SettingController::class, 'testEmail'])->name('settings.email');
});
