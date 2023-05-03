<?php

use App\Http\Controllers\Api\v1\AddressController;
use App\Http\Controllers\Api\v1\UserController;
use Illuminate\Support\Facades\Route;

Route::prefix('v1')->group(function () {
    Route::post('/user', [UserController::class, 'create']);
    Route::post('/address', [AddressController::class, 'create']);
});
