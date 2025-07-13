<?php

use App\Http\Controllers\MailController;
use App\Http\Controllers\NewsletterApiController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\SubscriberController;
use App\Http\Controllers\TemplateController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::middleware(['auth'])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');

    Route::get('/subscribers', [SubscriberController::class, 'index'])->name('subscribers.index');

    Route::get('/templates', [TemplateController::class, 'index'])->name('templates.index');
    Route::get('/templates/create', [TemplateController::class, 'create'])->name('templates.create');
    Route::post('/templates', [TemplateController::class, 'store'])->name('templates.store');

    Route::get('/newsletter/send', [MailController::class, 'showSendForm'])->name('newsletter.send.form');
    Route::post('/newsletter/send', [MailController::class, 'send'])->name('newsletter.send');
});

// API pour Alpine.js (templates et logs)
Route::middleware(['auth'])->group(function () {
    Route::get('/api/templates', [NewsletterApiController::class, 'templates']);
    Route::get('/api/newsletter-logs', [NewsletterApiController::class, 'logs']);
});

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
