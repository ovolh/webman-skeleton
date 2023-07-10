<?php

namespace app\admin\controller\auth;

use app\admin\validate\LoginValidate;
use app\Request;
use Shopwwi\WebmanAuth\Facade\Auth;

class LoginController
{
    /**
     * 登录
     * @param Request $request
     * @param LoginValidate $validate
     * @return \support\Response
     */
    public function login(Request $request, LoginValidate $validate): \support\Response
    {
        $data = $request->post();
        $token = Auth::guard('admin')->fail()->attempt($data);
        return success($token, '登入成功');
    }

}