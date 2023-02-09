<?php

namespace App\Api\Controller;

use support\Request;


class UserController
{

    /**
     * 用户信息
     * @param Request $request
     * @return \support\Response
     */
    public function userInfo(Request $request): \support\Response
    {
        return success_json($request->user);
    }
}
