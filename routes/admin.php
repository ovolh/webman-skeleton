<?php
use Webman\Route;

Route::get('/admin', [\App\Admin\Controller\IndexController::class, 'index']);
Route::group('/admin', function () {
     Route::get('/index', [App\Admin\Controller\IndexController::class, 'index']);
 });