<?php
/**
 * This file is part of webman.
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the MIT-LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @author    walkor<walkor@workerman.net>
 * @copyright walkor<walkor@workerman.net>
 * @link      http://www.workerman.net/
 * @license   http://www.opensource.org/licenses/mit-license.php MIT License
 */

use support\Log;
use support\Request;
use support\Response;
use Webman\Route;

// 给所有OPTIONS请求设置跨域
Route::options('[{path:.+}]', function () {
    return response('');
});

// 引用 routes 中的路由文件
foreach (glob(BASE_PATH . "/route/*.php") as $filename) {
    require_once $filename;
}

// 回退路由
Route::fallback(function (Request $request) {
    $time = microtime(true);

    // JSON响应
    if ($request->expectsJson()) {
        $response = new Response(404, [
            'Content-Type' => 'application/json',
            'Server' => 'webman'
        ], json_encode([
            'code' => 404,
            'msg' => '404 not found'
        ], JSON_UNESCAPED_UNICODE));
    } else { // 视图响应
        $response = new Response(404, [
            'Server' => 'webman'
        ], file_get_contents(public_path() . '/404.html'));
    }

    // 响应数据
    if (
        strpos($response->rawBody(), '<!DOCTYPE html>') !== false
        || strpos($response->rawBody(), '<!doctype html>') !== false
        || strpos($response->rawBody(), '<h1>') !== false
    ) {
        $body = 'html view';
    } else {
        $body = $response->rawBody();
    }

    // 运行时长
    $runTime = microtime(true) - $time;

    // 处理请求交互信息
    $requestLog = [
        'time' => date('Y-m-d H:i:s.', intval($time)) . substr((string)$time, 11),   // 请求时间（包含毫秒时间）
        'channel' => 'request',                                         // 日志通道
        'level' => 'DEBUG',                                           // 日志等级
        'message' => '',                                                // 描述
        'run_time' => $runTime ?? 0,                                     // 运行时长
        'ip' => $request->getRealIp() ?? '',      // 请求客户端IP
        'url' => $request->path() ?? '',                            // 请求URL
        'method' => $request->method() ?? '',                          // 请求方法
        'request_param' => $request->all() ?? [],                             // 请求参数
        'request_header' => $request->header() ?? [],                          // 请求头
        'cookie' => $request->cookie() ?? [],                          // 请求cookie
        'session' => $request->session()->all() ?? [],                  // 请求session
        'response_code' => $response->getStatusCode() ?? 404,                 // 响应码
        'response_header' => $response->getHeaders() ?? [],                     // 响应头
        'response_body' => $body ?? [],                                       // 响应数据
    ];

    // 记录日志
    Log::debug('route not found', $requestLog);

    return $response;
});
// 关闭自动路由
Route::disableDefaultRoute();