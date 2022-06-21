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
});
