<?php


    use Illuminate\Support\Facades\Route;

    Route::middleware('auth:sanctum')->prefix('users')->group(function(){
        Route::get('/', [\App\Http\Controllers\Api\V1\User\UserController::class, 'index'])->middleware('permission:confUser,read');
        Route::post('/', function () {
            return response()->json(['message' => 'Hello World']);
        })->middleware('permission:confUser,create');

        Route::get('current', [\App\Http\Controllers\Api\V1\User\UserController::class, 'currentUser']);
    });

