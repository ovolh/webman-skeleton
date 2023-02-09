<?php

namespace App\Api\Controller\Auth;

use Shopwwi\WebmanAuth\Facade\Auth;
use support\Request;

class LogoutController
{
    /**
     * 登出
     * @param Request $request
     * @return \support\Response
     */
    public function logout(Request $request): \support\Response
    {
        Auth::guard('user')->logout(true);
        return success_json([], '登出成功');
    }

}