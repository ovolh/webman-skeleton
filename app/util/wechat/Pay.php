<?php

namespace app\util\wechat;

use app\exception\ValidateException;
use EasyWeChat\Kernel\Exceptions\InvalidArgumentException;
use EasyWeChat\Pay\Application;
use EasyWeChat\Pay\Message;

class Pay
{
    /**
     * @var array
     */
    protected static $instance = [];

    /**
     * @param string $name
     * @param array $arguments
     * @return mixed
     */
    public static function __callStatic(string $name, array $arguments)
    {
        return static::client()->{$name}(... $arguments);
    }

    /**
     *  渠道
     * @param string $channel
     * @return mixed
     * @throws \EasyWeChat\Kernel\Exceptions\InvalidArgumentException
     */
    public static function channel(string $channel = 'default')
    {
        if (!isset(static::$instance[$channel])) {
            $config = config('wechat.pay');
            $config = $config[$channel] ?? $config['default'];
            static::$instance[$channel] = new Application($config);
        }
        return static::$instance[$channel];
    }

    /**
     * 获取client
     * @param string $channel
     * @return mixed
     * @throws \EasyWeChat\Kernel\Exceptions\InvalidArgumentException
     */
    public static function client(string $channel = 'default')
    {
        return static::channel($channel)->getClient();
    }

    /**
     * 获取工具类
     *
     * @return \EasyWeChat\MiniApp\Utils
     * @throws \EasyWeChat\Kernel\Exceptions\InvalidArgumentException
     */
    public static function utils(string $channel = 'default'): \EasyWeChat\MiniApp\Utils
    {
        return static::channel($channel)->getUtils();
    }

    /**
     * 获取配置
     * @param string $key
     * @param string $default
     * @param string $channel
     * @return mixed
     * @throws InvalidArgumentException
     */
    public static function getConfig(string $key, string $default = '', string $channel = 'default')
    {
        return static::config($channel)->get($key, $default);
    }

    /**
     * 设置配置
     * @param string $key
     * @param string $default
     * @param string $channel
     * @return mixed
     * @throws InvalidArgumentException
     */
    public static function setConfig(string $key, string $default = '', string $channel = 'default')
    {
        return static::config($channel)->set($key, $default);
    }

    /**
     * 获取配置
     * @param string $channel
     * @return mixed
     * @throws InvalidArgumentException
     */
    public static function config(string $channel = 'default')
    {
        return static::channel($channel)->getConfig();
    }

    /**
     * 小程序调起支付 API
     * @param string $prepayId
     * @param $appId
     * @param $signType
     * @param string $channel
     * @return mixed
     * @throws InvalidArgumentException
     *
     */
    public static function accessToken(string $prepayId, $appId, $signType = 'RSA', string $channel = 'default')
    {
        return static::utils($channel)->buildMiniAppConfig($prepayId, $appId, $signType);
    }

    /**
     * 支付成功事件
     * @param callable $handler
     * @param string $channel
     * @return mixed
     * @throws InvalidArgumentException
     * @throws ValidateException
     */
    public static function payNotify(callable $handler, string $channel = 'default')
    {
        $app = static::channel($channel);
        $server = $app->getServer();
        $server->handlePaid(function (Message $message, \Closure $next) use ($app, $handler) {
            // $message->out_trade_no 获取商户订单号
            // $message->payer['openid'] 获取支付者 openid
            // 🚨🚨🚨 注意：推送信息不一定靠谱哈，请务必验证
            // 建议是拿订单号调用微信支付查询接口，以查询到的订单状态为准
            try {
                $app->getValidator()->validate($app->getRequest());
                // 验证通过，业务处理
                $res = $handler($message);
                if (isset($res['status']) && !$res['status']) {
                    throw new ValidateException($res['message']);
                }
            } catch (\Exception $e) {
                // 验证失败
                throw new ValidateException($e->getMessage());
            }
            return $next($message);
        });
        return $server->serve();
    }

    /**
     * 退款成功事件
     * @param callable $handler
     * @param string $channel
     * @return mixed
     * @throws InvalidArgumentException
     * @throws ValidateException
     */
    public static function refundNotify(callable $handler, string $channel = 'default')
    {
        $app = static::channel($channel);
        $server = $app->getServer();
        $server->handleRefunded(function (Message $message, \Closure $next) use ($app, $handler) {
            // $message->out_trade_no 获取商户订单号
            // $message->payer['openid'] 获取支付者 openid
            // 🚨🚨🚨 注意：推送信息不一定靠谱哈，请务必验证
            // 建议是拿订单号调用微信支付查询接口，以查询到的订单状态为准
            try {
                $app->getValidator()->validate($app->getRequest());
                // 验证通过，业务处理
                $res = $handler($message);
                if (isset($res['status']) && !$res['status']) {
                    throw new ValidateException($res['message']);
                }
            } catch (\Exception $e) {
                // 验证失败
                throw new ValidateException($e->getMessage());
            }
            return $next($message);
        });
        return $server->serve();
    }
}