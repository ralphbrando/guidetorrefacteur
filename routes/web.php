<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Auth\ForgotPasswordController;
use App\Http\Controllers\TorrefacteurController;
use App\Http\Controllers\PaymentController;

Route::get('/', [HomeController::class, 'index'])->name('home');

// Authentication routes
Route::middleware('guest')->group(function () {
    Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
    Route::post('/login', [LoginController::class, 'login']);
    Route::get('/register', [RegisterController::class, 'showRegistrationForm'])->name('register');
    Route::post('/register', [RegisterController::class, 'register']);
    Route::get('/password/reset', [ForgotPasswordController::class, 'showLinkRequestForm'])->name('password.request');
    Route::post('/password/email', [ForgotPasswordController::class, 'sendResetLinkEmail'])->name('password.email');
    Route::get('/password/reset/{token}', [ForgotPasswordController::class, 'showResetForm'])->name('password.reset');
    Route::post('/password/reset', [ForgotPasswordController::class, 'reset'])->name('password.update');
});

Route::middleware('auth')->group(function () {
    Route::post('/logout', [LoginController::class, 'logout'])->name('logout');
    
    // Torrefacteur form
    Route::get('/torrefacteur/form', [TorrefacteurController::class, 'showForm'])->name('torrefacteur.form');
    Route::post('/torrefacteur/save', [TorrefacteurController::class, 'save'])->name('torrefacteur.save');
    Route::get('/torrefacteur/preview', [TorrefacteurController::class, 'preview'])->name('torrefacteur.preview');
    
    // Payment routes
    Route::get('/payment', [PaymentController::class, 'index'])->name('payment.index');
    Route::post('/payment/process', [PaymentController::class, 'process'])->name('payment.process');
    Route::get('/payment/success', [PaymentController::class, 'success'])->name('payment.success');
    Route::get('/payment/cancel', [PaymentController::class, 'cancel'])->name('payment.cancel');
    Route::post('/payment/stripe', [PaymentController::class, 'stripe'])->name('payment.stripe');
    Route::post('/payment/paypal', [PaymentController::class, 'paypal'])->name('payment.paypal');
});

// PDF routes (admin only - should add middleware)
Route::get('/pdf/preview', [App\Http\Controllers\PdfController::class, 'preview'])->name('pdf.preview');
Route::get('/pdf/generate', [App\Http\Controllers\PdfController::class, 'generate'])->name('pdf.generate');
Route::get('/pdf/illustrator', [App\Http\Controllers\PdfController::class, 'generateIllustrator'])->name('pdf.illustrator');

