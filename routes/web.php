<?php

use App\Livewire\VaccinationSignUpPage;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});
Route::get('/vaccination-sign-up', VaccinationSignUpPage::class)->name('sign-up');
