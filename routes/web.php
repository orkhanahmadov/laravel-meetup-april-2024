<?php

use App\Http\Controllers\CreateStripeCustomerController;
use App\Http\Controllers\FileUploadController;
use App\Http\Controllers\RegistrationPageController;
use Illuminate\Support\Facades\Route;

Route::get('register', RegistrationPageController::class)->name('register');
Route::post('stripe/customers/create', CreateStripeCustomerController::class)->name('stripe.customers.create');
Route::post('upload', FileUploadController::class)->name('upload');
