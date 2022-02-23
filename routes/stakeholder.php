<?php

use Illuminate\Support\Facades\Route;

Route::middleware(['auth','stakeholder'])
    ->prefix('stakeholder')
    ->name('stakeholder.')
    ->group(function () {
        Route::resource('reports',\App\Http\Controllers\StakeHolder\ReportController::class)->only(['index','show','update']);
    });
