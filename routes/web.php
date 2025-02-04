<?php

use Illuminate\Support\Facades\Route;
use effina\Larabanner\Http\Controllers\LarabannerController;

Route::middleware(config('larabanner.middleware'))
     ->prefix(config('larabanner.route_prefix'))
     ->name('larabanner.')
     ->group(function () {
         Route::resource('/', LarabannerController::class)
              ->parameters(['' => 'banner']);
     });
