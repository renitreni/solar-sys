<?php

use App\Http\Controllers\Actions\GetCompanyLogo;
use App\Http\Controllers\Actions\GetImage;
use App\Http\Controllers\LogoutController;
use App\Livewire\CompanyLogoLivewire;
use App\Livewire\CustomerLivewire;
use App\Livewire\DashboardLivewire;
use App\Livewire\JobStatusLivewwire;
use App\Livewire\LoginLivewire;
use App\Livewire\PropertyAddressLivewwire;
use App\Livewire\PropertyOwnerLivewwire;
use App\Livewire\PropertyTypeLivewwire;
use App\Livewire\ServiceLivewire;
use App\Livewire\UserLivewire;
use App\Models\PropertyAddress;
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

    Route::prefix('reference')->group(function () {
        Route::get('/customers', CustomerLivewire::class)->name('customers');
        Route::get('/property-type', PropertyTypeLivewwire::class)->name('property-type');
        Route::get('/property-address', PropertyAddressLivewwire::class)->name('property-address');
        Route::get('/property-owner', PropertyOwnerLivewwire::class)->name('property-owner');
        Route::get('/service', ServiceLivewire::class)->name('service');
        Route::get('/job-status', JobStatusLivewwire::class)->name('job-status');
    });
});
