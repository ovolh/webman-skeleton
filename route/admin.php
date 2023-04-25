<?php

use Webman\Route;

// 测试
Route::get('/admin', [App\Admin\Controller\IndexController::class, 'index'])->name('index');
Route::get('/admin/index/index', [App\Admin\Controller\IndexController::class, 'index'])->name('test');


Route::group('/admin', function () {
    // 未登录
    Route::group(function () {
        Route::post('/login', [App\Admin\Controller\Auth\LoginController::class, 'login'])->name('login');
    });

    // 已登录
    Route::group(function () {
        Route::get('/users/user_info', [App\Admin\Controller\UserController::class, 'userInfo'])->name('userInfo');
        Route::post('/logout', [App\Admin\Controller\Auth\LogoutController::class, 'logout'])->name('logout');
        Route::post('/refresh_token', [App\Admin\Controller\Auth\AuthController::class, 'refreshToken'])->name('refreshToken');

    })->middleware([App\Admin\Middleware\AdminAuthMiddleware::class]);
 });