<?php

use App\Http\Controllers\API\SchoolController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::middleware('auth:sanctum')->get('/auth', function (Request $request) {
    return "this";
});

Route::group(['prefix' => 'v1', ], function() {
    Route::get('/employees', [SchoolController::class, 'index']);
    Route::get('/employee/{employeeId}/classes', [SchoolController::class, 'staffClasses']);

    Route::get('/class/{id}', [SchoolController::class, 'class']);
});
