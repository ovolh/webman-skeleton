<?php

namespace App\Admin\Controller;

use App\Request;


class UserController
{

    /**
     * 用户信息
     * @param Request $request
     * @return \support\Response
     */
    public function userInfo(Request $request): \support\Response
    {

        return success($request->user);
    }
}
