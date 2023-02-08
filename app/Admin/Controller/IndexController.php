<?php

namespace App\Admin\Controller;

use App\Admin\Validate\UserValidate;
use App\Model\User;
//use support\Cache;
use App\Service\Mailer;
use Shopwwi\LaravelCache\Cache;
use support\Db;
//use support\Redis;
use support\Request;
use Webman\RedisQueue\Redis;

class IndexController
{
    private $mailer;

    public function __construct(Mailer $mailer)
    {
        $this->mailer = $mailer;
    }

    public function index(Request $request, Mailer $mailer)
    {
        // 队列名
        $queue = 'send-mail';
        // 数据，可以直接传数组，无需序列化
        $data = ['to' => 'tom@gmail.com', 'content' => 'hello'];
        // 投递消息
        Redis::send($queue, $data);
        $mailer->mail('hello@webman.com', 'Hello and welcome!');
        $hello = trans('hello'); // 你好 世界!
        return response($hello);
//        $data = [
//            'name'  => 'thinkphp',
//            'email' => 'thinkphp@qq',
//            'age' => '11',
//            'migration_name' => 'CreateUsersTable',
//            'body' => 'CreateUsersTable',
//        ];
//
//        $validate = new UserValidate();
//
//        if (!$validate->scene('edit')->check($data)) {
//            var_dump($validate->getError());
//        }

//        $validator = validator($data, [
//            'migration_name' => 'required|unique:migrations|max:255',
//            'body' => 'required',
//        ],[
//            'migration_name.unique' => 'sdfsdfd'
//        ]);
//        if ($validator->fails()) {
//            return json($validator->errors()->first());
//        }
//        return json('ok');
//        $key = 'test_key';
//        Cache::put('bar', 'baz', 600);
//        cache(['key' => 'value'], 60);
//        cache('key');
//        Redis::set($key, rand());
//        return response(Redis::get($key));
//        return response('hello webman');
//        $key = 'test_key';
//        Cache::set($key, rand());
//        return response(Cache::get($key));
        return response('sdfd');
    }

    public function view(Request $request)
    {
        return view('index/view', ['name' => 'webman']);
    }

    public function json(Request $request)
    {
        return json(['code' => 0, 'msg' => 'ok']);
    }

}
