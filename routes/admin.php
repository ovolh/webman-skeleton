<?php

use App\Admin\Controller\Auth\AuthController;
use App\Admin\Controller\Auth\LoginController;
use App\Admin\Controller\Auth\LogoutController;
use App\Admin\Controller\IndexController;
use App\Admin\Controller\UserController;
use App\Admin\Middleware\AdminAuthMiddleware;
use Webman\Route;


Route::get('/admin', [IndexController::class, 'index'])->name('index');

Route::group('/admin', function () {
    // 未登录
    Route::group(function () {
        Route::post('/login', [LoginController::class, 'login'])->name('login');
    });

    // 已登录
    Route::group(function () {
        Route::get('/users/user_info', [UserController::class, 'userInfo'])->name('userInfo');
        Route::post('/logout', [LogoutController::class, 'logout'])->name('logout');
        Route::post('/refresh_token', [AuthController::class, 'refreshToken'])->name('refreshToken');

    })->middleware([AdminAuthMiddleware::class]);
 });