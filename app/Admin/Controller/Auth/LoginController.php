<?php

namespace App\Admin\Controller\Auth;

use App\Admin\Validate\LoginValidate;
use Shopwwi\WebmanAuth\Facade\Auth;
use support\Request;

class LoginController
{
    /**
     * 登录
     * @param Request $request
     * @return \support\Response
     */
    public function login(Request $request)
    {
        $validate = new LoginValidate();
        $data = $request->post();
        if (!$validate->check($data)) {
            return fail_json($validate->getError());
        }
        $token = Auth::guard('admin')->fail()->attempt($data);
        return success_json($token, '登入成功');
    }

}