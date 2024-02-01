<?php

use App\Livewire\VaccinationSignUpPage;
use App\Http\Controllers\WebhookController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});
Route::get('/vaccination-sign-up', VaccinationSignUpPage::class)->name('sign-up');
Route::post('/webhook/register', [WebhookController::class, 'register'])->name('webhook.register');
