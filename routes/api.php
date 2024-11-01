<?php

use Illuminate\Support\Facades\Route;
use Module\Procurement\Http\Controllers\DashboardController;


Route::get('dashboard', [DashboardController::class, 'index']);