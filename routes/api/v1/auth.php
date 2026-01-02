<?php
    use Illuminate\Support\Facades\Route;

    Route::prefix('auth')->group(function(){
       Route::get('/', function () {
            return response()->json(['message' => 'Hello World']);
       });

       Route::post('/login', [\App\Http\Controllers\Api\V1\Auth\AuthController::class, 'login']);

    });
