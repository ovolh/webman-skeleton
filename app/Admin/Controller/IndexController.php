<?php

namespace App\Admin\Controller;

use support\Request;

class IndexController
{
    public function index(Request $request): \support\Response
    {
        return success_json();
    }

}
