<?php
/**
 * 节流设置
 * @copyright The PHP-Tools
 */

namespace App\Middleware;

use Webman\Http\Request;
use Webman\Http\Response;
use Webman\MiddlewareInterface;

/**
 * Class StaticFile
 * @package app\middleware
 */
class Throttle implements MiddlewareInterface
{
    public function process(Request $request, callable $next): Response
    {
        if ($route = $request->route) {
            $params = $route->param();
        }
        return (new \yzh52521\middleware\Throttle())->handle($request, $next, $params ?? []);
    }
}