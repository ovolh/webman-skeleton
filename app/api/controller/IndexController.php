<?php

namespace app\api\controller;

use app\Request;
use app\util\wechat\MiniApp;

class IndexController
{
    public function index(Request $request): \support\Response
    {
        $res = MiniApp::getConfig('app_id', '12323');
        return success($res);
    }

}
