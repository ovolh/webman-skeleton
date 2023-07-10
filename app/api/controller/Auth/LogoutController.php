<?php

namespace app\api\controller\auth;

use app\Request;
use Shopwwi\WebmanAuth\Facade\Auth;

class LogoutController
{
    /**
     * 登出
     * @param Request $request
     * @return \support\Response
     */
    public function logout(Request $request): \support\Response
    {
        Auth::logout();
        return success([], '登出成功');
    }

}