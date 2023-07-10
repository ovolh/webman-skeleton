<?php

namespace app\util\wechat;

use EasyWeChat\Kernel\Exceptions\DecryptException;
use EasyWeChat\Kernel\Exceptions\InvalidArgumentException;
use EasyWeChat\MiniApp\Application;

class MiniApp
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
            $config = config('wechat.mini_app');
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
     * 解密会话信息
     * @param string $sessionKey
     * @param string $iv
     * @param string $encryptedData
     * @param string $channel
     * @return mixed
     * @throws DecryptException
     * @throws InvalidArgumentException
     */
    public function decryptSession(string $sessionKey, string $iv, string $encryptedData, string $channel = 'default')
    {
        return static::utils($channel)->decryptSession($sessionKey, $iv, $encryptedData);
    }

    /**
     * code 换取 openid
     * @param string $code
     * @return mixed
     */
    public static function codeToSession(string $code, string $channel = 'default')
    {
        return static::utils($channel)->codeToSession($code);
    }

    /**
     * 获取 access_token
     * @param string $channel
     * @return mixed
     * @throws InvalidArgumentException
     *
     */
    public static function accessToken(string $channel = 'default')
    {
        return static::channel($channel)->getAccessToken()->getToken();
    }
}