<?php

    use Illuminate\Support\Facades\Route;

    Route::group([], function () {
        require __DIR__.'/v1/auth.php';
        require __DIR__.'/v1/user.php';
//        require __DIR__.'/v1/purchase.php';
//        require __DIR__.'/v1/stock.php';
//        require __DIR__.'/v1/master.php';
    });
