<?php

namespace App\Api\Controller\Auth;

use App\Api\Validate\LoginValidate;
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
        $token = Auth::guard('user')->fail()->attempt($data);
        return success_json($data);
    }
}