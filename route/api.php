<?php

use Webman\Route;


Route::group('/api', function () {
    // 未登录
    Route::group(function () {
        Route::get('/index', [app\api\controller\IndexController::class, 'index'])->name('index');
        Route::post('/login', [app\api\controller\auth\LoginController::class, 'login'])->name('login');
    });

    // 已登录
    Route::group(function () {
        Route::get('/users/user_info', [app\api\controller\UserController::class, 'userInfo'])->name('userInfo');
        Route::post('/logout', [app\api\controller\auth\LogoutController::class, 'logout'])->name('logout');
        Route::post('/refresh_token', [app\api\controller\auth\AuthController::class, 'refreshToken'])->name('refreshToken');

    })->middleware([app\api\middleware\ApiAuthMiddleware::class]);
});