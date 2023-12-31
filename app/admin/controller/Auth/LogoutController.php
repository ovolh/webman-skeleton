<?php

namespace app\admin\controller\auth;

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
        Auth::guard('admin')->logout(true);
        return success([], '登出成功');
    }

}