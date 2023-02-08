<?php

return [
    'user.register' => [
        [App\Event\User::class, 'register'],
        // ...其它事件处理函数...
    ],
    'user.logout' => [
        [app\Event\User::class, 'logout'],
        // ...其它事件处理函数...
    ]
];
