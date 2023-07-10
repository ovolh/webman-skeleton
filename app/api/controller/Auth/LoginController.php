<?php

namespace app\api\controller\auth;

use app\api\validate\LoginValidate;
use app\Request;
use Shopwwi\WebmanAuth\Facade\Auth;

class LoginController
{
    /**
     * 登录
     * @param Request $request
     * @return \support\Response
     */
    public function login(Request $request, LoginValidate $validate): \support\Response
    {
        $data = $request->post();
        $token = Auth::fail()->attempt($data);
        return success($token);
    }
}