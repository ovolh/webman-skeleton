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

namespace app\admin\middleware;

use Shopwwi\WebmanAuth\Facade\Auth;
use Tinywan\ExceptionHandler\Exception\BadRequestHttpException;
use Webman\Http\Request;
use Webman\Http\Response;
use Webman\MiddlewareInterface;

/**
 * Class StaticFile
 * @package app\middleware
 */
class AdminAuthMiddleware implements MiddlewareInterface
{
    /**
     * 后台用户
     * @param Request $request
     * @param callable $handler
     * @return Response
     * @throws BadRequestHttpException
     */
    public function process(Request $request, callable $handler): Response
    {
        $user = Auth::guard('admin')->fail()->user(); //当前登入管理员
        if (!$user) {
            throw new BadRequestHttpException('请重新登陆！');
        }
        $request->id = $user->id;
        $request->user = $user;
        return $handler($request);
    }
}
