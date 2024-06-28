<?php

use App\Http\Controllers\Actions\GetCompanyLogo;
use App\Http\Controllers\Actions\GetImage;
use App\Http\Controllers\LogoutController;
use App\Livewire\CompanyLogoLivewire;
use App\Livewire\DashboardLivewire;
use App\Livewire\LoginLivewire;
use App\Livewire\UserLivewire;
use Illuminate\Support\Facades\Route;

Route::middleware(['guest'])->group(function () {
    Route::get('/login', LoginLivewire::class)->name('login');
});

Route::get('/get-company-logo', GetCompanyLogo::class)->name('get-company-logo');

Route::middleware(['auth', 'web'])->group(function () {
    Route::get('/logout', [LogoutController::class, 'logout'])->name('logout');
    Route::get('/get-image', GetImage::class)->name('get-image');

    Route::get('/home', DashboardLivewire::class)->name('home');

    Route::prefix('users')->group(function () {
        Route::get('/', UserLivewire::class)->name('user');
    });

    Route::prefix('settings')->group(function () {
        Route::get('/company-logo', CompanyLogoLivewire::class)->name('company-logo');
    });
});
