# 自用 webman 封装骨架

## 环境要求
- PHP >= 8.0

- Composer >= 2.0

## 步骤

1. 下载项目
```bash
git clone https://gitee.com/oulinhui/webman-skeleton.git webman
```

2. 安装扩展
```bash
composer install
```

3. 创建配置文件
```bash
cp .env.example .env
```

4. 修改 .env 中环境变量

5. 生成APP KEY, JWT密钥(命令行)等
```bash
php webman key:generate
```
   
6. 启动
    - 调试模式 `php webman start`
    - 正式环境 `php webman start -d`

## 扩展包说明
- 数据库
[illuminate/database](https://learnku.com/docs/laravel/10.x/database/9400)
- Redis
[illuminate/redis](https://github.com/illuminate/redis)
- Cache
[shopwwi/laravel-cache](https://www.workerman.net/plugin/95)
- Redis 队列
[webman/redis-queue](https://www.workerman.net/plugin/12)
- 验证器
[tinywan/validate](https://www.workerman.net/plugin/7) 不支持 `unquire`
- 多语言
[symfony/translation](https://www.workerman.net/doc/webman/components/translation.html)
- Event 事件
[webman/event](https://www.workerman.net/plugin/64)
- Env 环境变量
[vlucas/phpdotenv](https://www.workerman.net/doc/webman/components/env.html)
- 文件存储
  [shopwwi/webman-filesystem](https://www.workerman.net/plugin/19)
- 日志插件
  [webman/log](https://www.workerman.net/plugin/61)
- 🔑Auth多用户认证/单点登入
  [shopwwi/webman-auth](https://www.workerman.net/plugin/24)
- Exception 异常
  [tinywan/exception-handler](https://www.workerman.net/plugin/16)
- 跨域请求
  [webman/cors](https://www.workerman.net/plugin/31)
- 命令行
  [webman/console](https://www.workerman.net/doc/webman/plugin/console.html)
- HTTP客户端
  [yzh52521/easyhttp](https://www.workerman.net/plugin/94)
- 业务锁
  [yzh52521/webman-lock](https://www.workerman.net/plugin/56)
- 限流中间件
  [yzh52521/webman-throttle](https://www.workerman.net/plugin/26)
- crontab定时任务
 [workerman/crontab](https://www.workerman.net/doc/webman/components/crontab.html)
- 哈希加密
 [yzh52521/webman-hash](https://www.workerman.net/plugin/53)
- 邮件
  [yzh52521/webman-mailer](https://www.workerman.net/plugin/32)
- 数据迁移填充
  [pxianyu/migrations](https://www.workerman.net/plugin/112)
