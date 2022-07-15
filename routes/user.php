<?php

use App\Http\Controllers\AllergyController;
use App\Http\Controllers\AppointmentController;
use App\Http\Controllers\MedicationController;
use App\Http\Controllers\SubscriptionController;
use Illuminate\Support\Facades\Route;


Route::group(['prefix' => 'user', 'as' => 'user.', 'middleware' => 'subscription'], function () {
    Route::resource('allergies', AllergyController::class);
    Route::resource('medications', MedicationController::class);
    Route::resource('appointments', AppointmentController::class);
    Route::get('subscriptions', [SubscriptionController::class, 'userSubscriptions'])->name('subscription');
    Route::get('subscription/cancel', [SubscriptionController::class, 'cancelSubscription'])->name('subscription.cancel');
    Route::get('subscription/resume', [SubscriptionController::class, 'resumeSubscription'])->name('subscription.resume');

    Route::get('subscription/download/{id}', [SubscriptionController::class, 'download'])->name('invoice.download');
});
