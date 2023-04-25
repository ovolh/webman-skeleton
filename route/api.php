<?php

use Webman\Route;

Route::get('/api', [App\Api\Controller\IndexController::class, 'index'])->name('index');

Route::group('/api', function () {
    // 未登录
    Route::group(function () {
        Route::post('/login', [App\Api\Controller\Auth\LoginController::class, 'login'])->name('login');
    });

    // 已登录
    Route::group(function () {
        Route::get('/users/user_info', [App\Api\Controller\UserController::class, 'userInfo'])->name('userInfo');
        Route::post('/logout', [App\Api\Controller\Auth\LogoutController::class, 'logout'])->name('logout');
        Route::post('/refresh_token', [App\Api\Controller\Auth\AuthController::class, 'refreshToken'])->name('refreshToken');

    })->middleware([App\Api\Middleware\ApiAuthMiddleware::class]);
});