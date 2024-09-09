<?php

use App\Http\Controllers\Actions\GetClientSelect;
use App\Http\Controllers\Actions\GetCompanyLogo;
use App\Http\Controllers\Actions\GetImage;
use App\Http\Controllers\LogoutController;
use App\Livewire\CompaniesLivewire;
use App\Livewire\CompanyLogoLivewire;
use App\Livewire\CustomerLivewire;
use App\Livewire\DashboardLivewire;
use App\Livewire\JobStatusLivewire;
use App\Livewire\LoginLivewire;
use App\Livewire\ProjectJobCreateLivewire;
use App\Livewire\ProjectJobFileLivewire;
use App\Livewire\ProjectJobFormLivewire;
use App\Livewire\ProjectJobLivewire;
use App\Livewire\ServiceLivewire;
use App\Livewire\UserLivewire;
use Illuminate\Support\Facades\Route;

Route::middleware(['guest'])->group(function () {
    Route::get('/login', LoginLivewire::class)->name('login');
    Route::get('/', fn () => redirect()->route('login'));
});

Route::get('/get-company-logo', GetCompanyLogo::class)->name('get-company-logo');

Route::middleware(['auth', 'web'])->group(function () {
    Route::get('/logout', [LogoutController::class, 'logout'])->name('logout');
    Route::get('/get-image', GetImage::class)->name('get-image');

    Route::get('/get/selec2/clients', GetClientSelect::class)->name('get.client.select');

    Route::get('/home', DashboardLivewire::class)->name('home');

    Route::prefix('project-management')->group(function () {
        Route::get('/project-job', ProjectJobLivewire::class)->name('project-job');
        Route::get('/project-job-form/create', ProjectJobCreateLivewire::class)->name('project-job-form');
        Route::get('/project-job-form/edit/{id}', ProjectJobFormLivewire::class)->name('project-job-form.edit');
        Route::get('/project-job-file/{id}', ProjectJobFileLivewire::class)->name('project-job-file');
    });

    Route::prefix('reference')->group(function () {
        Route::get('/clients', CustomerLivewire::class)->name('clients');
        Route::get('/companies', CompaniesLivewire::class)->name('companies');
        Route::get('/service', ServiceLivewire::class)->name('service');
        Route::get('/job-status', JobStatusLivewire::class)->name('job-status');
    });

    Route::prefix('users')->group(function () {
        Route::get('/', UserLivewire::class)->name('user');
    });

    Route::prefix('settings')->group(function () {
        Route::get('/company-logo', CompanyLogoLivewire::class)->name('company-logo');
    });
});
