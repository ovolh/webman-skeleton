<?php

namespace App\Admin\Controller;

use App\Request;
use App\Util\CrontabFrequencies;
use Illuminate\Support\Str;
use support\Db;

class IndexController
{
    public function index(Request $request)
    {
        return success([]);
    }

}
