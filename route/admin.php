<?php

use Webman\Route;

// 测试
Route::group('/admin', function () {
    // 未登录
    Route::group(function () {
        Route::get('/index', [app\admin\controller\IndexController::class, 'index'])->name('test');
        Route::post('/login', [app\admin\controller\auth\LoginController::class, 'login'])->name('login');
    });

    // 已登录
    Route::group(function () {
        Route::get('/users/user_info', [app\admin\controller\UserController::class, 'userInfo'])->name('userInfo');
        Route::post('/logout', [app\admin\controller\auth\LogoutController::class, 'logout'])->name('logout');
        Route::post('/refresh_token', [app\admin\controller\auth\AuthController::class, 'refreshToken'])->name('refreshToken');

    })->middleware([app\admin\middleware\AdminauthMiddleware::class]);
});