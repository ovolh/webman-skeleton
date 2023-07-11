<?php
/**
 * ip 转换 地址
 */
namespace app\util;

use XdbSearcher;

class IpToRegion
{

    /**
     * ip地址转换为地区名
     */
    public function ipToRegion($clientIP = ''): array
    {
        if ($clientIP == '127.0.0.1') {
            return ['country' => '', 'province' => '', 'city' => '', 'isp' => ''];
        }
        $address = $this->convertIp($clientIP);

        return $address;
    }

    /**
     * 优先使用 zoujingli/ip2region
     * @param $clientIP
     * @return array|string[]
     */
    public function convertIp($clientIP): array
    {
        try {
            $searcher = XdbSearcher::newWithBuffer(null);
            $region = $searcher->search($clientIP);
            if ($region === null) {
                return $this->speedTest($clientIP);
            }
            // 国家|区域|省份|城市|ISP
            $address = explode('|', $region);
            $res = [];
            $res['country'] = $address[0] ?: '';
            $res['province'] = $address[2] ?: '';
            $res['city'] = $address[3] ?: '';
            $res['isp'] = $address[4] ?: '';
        } catch (\Exception $e) {
            $res = $this->speedTest($clientIP);
        }
        return $res;
    }

    /**
     * speedtest
     * @param $clientIP
     * @return array|string[]
     */
    public function speedTest($clientIP): array
    {
        $res = [];
        $content = $this->curlGet("https://forge.speedtest.cn/api/location/info?ip={$clientIP}");
        $contentArr = json_decode($content, true);

        $res['country'] = !empty($contentArr['country']) ? $contentArr['country'] : '';
        $res['province'] = !empty($contentArr['province']) ? $contentArr['province'] : '';
        $res['city'] = !empty($contentArr['city']) ? $contentArr['city'] : '';
        $res['isp'] = !empty($contentArr['isp']) ? $contentArr['isp'] : '';
        //使用 ip_cn 解析
        if (empty($res['province']) || empty($res['city'])) {
            $res = $this->ipCn($clientIP);
        }

        return $res;
    }

    /**
     * 请求
     * @param $url
     * @return bool|string
     */
    private function curlGet($url): bool|string
    {
        $ch = curl_init();
        $header[] = "";
        curl_setopt($ch, CURLOPT_HTTPHEADER, $header);
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_REFERER, $url);
        curl_setopt($ch, CURLOPT_USERAGENT,
            "Mozilla/5.0 (Windows NT 5.1) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/50.0.2661.102 Safari/537.36");
        curl_setopt($ch, CURLOPT_TIMEOUT, 2);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
        $content = curl_exec($ch);
        curl_close($ch);

        return $content;
    }

    /**
     * ip.cn
     * @param $clientIP
     * @return string[]
     */
    public function ipCn($clientIP): array
    {
        $res = ['country' => '', 'province' => '', 'city' => '', 'isp' => ''];

        $content = $this->curlGet("https://ip.cn/api/index?ip={$clientIP}&type=1");
        $contentArr = json_decode($content, true);
        if (empty($contentArr['address'])) {
            return $res;
        }
        $address = explode(' ', $contentArr['address']);
        $address = array_values(array_filter($address));
        $res['country'] = !empty($address[0]) ? $address[0] : '';
        $res['province'] = !empty($address[1]) ? $address[1] : '';
        $res['city'] = !empty($address[2]) ? $address[2] : '';
        $res['isp'] = !empty($address[3]) ? $address[3] : '';

        //使用 cz88.net 解析
        if (empty($res['province']) || empty($res['city'])) {
            $res = $this->cz88Net($clientIP);
        }

        return $res;

    }

    /**
     * cz88.net
     * @param $clientIP
     * @return string[]
     */
    public function cz88Net($clientIP): array
    {
        $res = ['country' => '', 'province' => '', 'city' => '', 'isp' => ''];

        $content = $this->curlGet("https://www.cz88.net/api/cz88/ip/iplab?ip={$clientIP}");
        $contentArr = json_decode($content, true);
        if (empty($contentArr) || $contentArr['code'] != '200') {
            return $res;
        }
        if (empty($contentArr['data'])) {
            return $res;
        }
        $data = $contentArr['data'];
        $netAddress = explode('-', $data['netAddress']);
        $res['country'] = !empty($netAddress[0]) ? $netAddress[0] : '';
        $res['province'] = !empty($netAddress[1]) ? $netAddress[1] : '';
        $res['city'] = !empty($netAddress[2]) ? $netAddress[2] : '';
        $res['isp'] = !empty($data['isp']) ? $data['isp'] : '';

        if (empty($res['province']) || empty($res['city'])) {
            $res = $this->ipApi($clientIP);
        }

        return $res;
    }

    /**
     * http://ip-api.com/
     * @param $clientIP
     * @return string[]
     */
    public function ipApi($clientIP): array
    {
        $res = ['country' => '', 'province' => '', 'city' => '', 'isp' => ''];

        $content = $this->curlGet("http://ip-api.com/json/{$clientIP}?lang=zh-CN");
        $contentArr = json_decode($content, true);
        if (empty($contentArr)) {
            return $res;
        }
        if (!empty($contentArr['status']) && $contentArr['status'] != 'success') {
            return $res;
        }
        $res['country'] = !empty($contentArr['country']) ? $contentArr['country'] : '';
        $res['province'] = !empty($contentArr['regionName']) ? $contentArr['regionName'] : '';
        $res['city'] = !empty($contentArr['city']) ? $contentArr['city'] : '';
        $res['isp'] = !empty($contentArr['isp']) ? $contentArr['isp'] : '';

        return $res;
    }

}
