<?php

use App\Api\Controller\Auth\AuthController;
use App\Api\Controller\Auth\LoginController;
use App\Api\Controller\Auth\LogoutController;
use App\Api\Controller\IndexController;
use App\Api\Controller\UserController;
use App\Api\Middleware\ApiAuthMiddleware;
use Webman\Route;

Route::get('/api', [IndexController::class, 'index'])->name('index');

Route::group('/api', function () {
    // 未登录
    Route::group(function () {
        Route::post('/login', [LoginController::class, 'login'])->name('login');
    });

    // 已登录
    Route::group(function () {
        Route::get('/users/user_info', [UserController::class, 'userInfo'])->name('userInfo');
        Route::post('/logout', [LogoutController::class, 'logout'])->name('logout');
        Route::post('/refresh_token', [AuthController::class, 'refreshToken'])->name('refreshToken');

    })->middleware([ApiAuthMiddleware::class]);
});