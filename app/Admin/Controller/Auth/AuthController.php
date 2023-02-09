<?php

namespace App\Admin\Controller\Auth;

use Shopwwi\WebmanAuth\Facade\Auth;
use support\Request;

class AuthController
{

    /**
     * 刷新token
     * @param Request $request
     * @return \support\Response
     */
    public function refreshToken(Request $request)
    {
        $refresh = Auth::guard('admin')->fail()->refresh();
        return success_json($refresh, '刷新token成功');
    }

}