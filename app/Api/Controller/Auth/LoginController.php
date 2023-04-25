<?php

namespace App\Api\Controller\Auth;

use App\Api\Validate\LoginValidate;
use App\Request;
use Shopwwi\WebmanAuth\Facade\Auth;

class LoginController
{
    /**
     * 登录
     * @param Request $request
     * @return \support\Response
     */
    public function login(Request $request, LoginValidate $validate)
    {
        $data = $request->post();
        $token = Auth::guard('user')->fail()->attempt($data);
        return success($data);
    }
}