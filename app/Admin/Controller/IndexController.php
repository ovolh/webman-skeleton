<?php

namespace App\Admin\Controller;

use App\Request;
use App\Util\CrontabFrequencies;
use support\Db;

class IndexController
{
    public function index(Request $request)
    {
        $dd = new CrontabFrequencies();
        Db::select();
        return success($dd->everySecond());
    }

}
