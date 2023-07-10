<?php

namespace app\admin\controller\auth;

use app\Request;
use Shopwwi\WebmanAuth\Facade\Auth;

class AuthController
{

    /**
     * 刷新token
     * @param Request $request
     * @return \support\Response
     */
    public function refreshToken(Request $request): \support\Response
    {
        $refresh = Auth::guard('admin')->fail()->refresh();
        return success($refresh, '刷新token成功');
    }

}