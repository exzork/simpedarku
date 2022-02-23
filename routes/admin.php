<?php

use App\Http\Controllers\Admin\ReportController;
use App\Http\Controllers\Admin\StakeHolderController;
use App\Http\Controllers\Admin\UserController;
use Illuminate\Support\Facades\Route;

Route::middleware(['auth', 'admin'])
    ->prefix('admin')
    ->name('admin.')
    ->group(function () {
        Route::resource('stakeholders', StakeholderController::class)->except('show');
        Route::resource('reports', ReportController::class)->only(['index', 'show', 'update']);
        Route::resource('users', UserController::class)->only(['index', 'show', 'update', 'destroy']);
    });
