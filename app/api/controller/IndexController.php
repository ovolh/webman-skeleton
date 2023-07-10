<?php

namespace app\api\controller;

use app\Request;

class IndexController
{
    public function index(Request $request): \support\Response
    {
        return success();
    }

}
