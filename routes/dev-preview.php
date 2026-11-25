<?php

use App\Http\Controllers\Dev\DashboardPreviewController;
use Illuminate\Support\Facades\Route;

// Este grupo se registra sin el middleware web ni las sesiones del portal.
Route::get('/dev/preview/dashboard', DashboardPreviewController::class);
