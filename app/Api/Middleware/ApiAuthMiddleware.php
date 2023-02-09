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

namespace App\Api\Middleware;

use Shopwwi\WebmanAuth\Facade\Auth;
use Tinywan\ExceptionHandler\Exception\BadRequestHttpException;
use Webman\Http\Request;
use Webman\Http\Response;
use Webman\MiddlewareInterface;

/**
 * Class StaticFile
 * @package app\middleware
 */
class ApiAuthMiddleware implements MiddlewareInterface
{
    public function process(Request $request, callable $next): Response
    {
        $user = Auth::guard('user')->user(); //当前登入用户
        if (!$user) {
            throw new BadRequestHttpException('请重新登陆！');
        }
        $request->id = $user->id;
        $request->user = $user;
        return $next($request);
    }
}
