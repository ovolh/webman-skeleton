<?php

namespace App\Api\Controller;

use App\Request;

class IndexController
{
    public function index(Request $request): \support\Response
    {
        return success();
    }

}
