<?php

namespace App\BasicShop\UCenter;

/**
 * Class UCenter
 * @package App\BasicShop\UCenter
 */
class UCenter
{

    /**
     * @var string
     */
    protected $_token;

    /**
     * @var string
     */
    protected $_appId;

    /**
     * @var string
     */
    protected $_url;

    /**
     * @throws \Exception
     */
    public function __construct()
    {
        $this->_appId = env('UCENTER_APPID');
        $this->_url = env('UCENTER_API_URL');
        if (\Session::has('uc_token') && \Session::get('uc_token')) {
            $this->_token = \Session::get('uc_token');
        } else {
            $token = $this->getToken();
            \Session::set('uc_token', $token);
            $this->_token = $token;
        }
    }


    /**
     * @return mixed
     * @throws \Exception
     */
    function getToken()
    {
        $request = [
            'url' => $this->_url . '/api/public/get_token',
            'params' => [
                'appId' => $this->_appId
            ]
        ];
        $response = \MyHttp::post($request);
        $result = $response->json();
        if ($result->code == 200) {
            return $result->data;
        } else {
            throw new \Exception($result->msg);
        }
    }

    /**
     * @param $phone
     * @param $action
     * @param $beans
     * @return mixed
     * @throws \Exception
     */
    function updateBeans($phone, $action, $beans)
    {
        $request = [
            'url' => $this->_url . '/api/credit/index',
            'params' => [
                'phone' => $phone,
                'token' => $this->_token,
                'appId' => $this->_appId,
                'action' => $action,
                'mdBeans' => $beans,
            ]
        ];
        $response = \MyHttp::post($request);
        $result = $response->json();
        if ($result->code == 200) {
            return $result->data;
        } else {
            throw new \Exception($result->msg);
        }
    }

    /**
     * @param $phone
     * @param $password
     * @return bool
     * @throws \Exception
     */
    function register($phone, $password)
    {
        $request = [
            'url' => $this->_url . '/api/public/register',
            'params' => [
                'token' => $this->_token,
                'appId' => $this->_appId,
                'phone' => $phone,
                'password' => $password
            ]
        ];
        $response = \MyHttp::post($request);
        $result = $response->json();
        dd($result);
        if ($result->code == 200) {
            return true;
        } else {
            throw new \Exception($result->msg);
        }
    }

    /**
     * @param $phone
     * @param $password
     * @return bool
     * @throws \Exception
     */
    function setPwd($phone, $password)
    {
        $request = [
            'url' => $this->_url . '/api/public/setPwd',
            'params' => [
                'token' => $this->_token,
                'appId' => $this->_appId,
                'phone' => $phone,
                'password' => $this->tcodes($password),
                'repassword' => $this->tcodes($password)
            ]
        ];
        $response = \MyHttp::post($request);
        $result = $response->json();
        if ($result->code == 200) {
            return true;
        } else {
            throw new \Exception($result->msg);
        }
    }

    /**
     * @param $string
     * @param bool|true $isEncrypt 加密:true 解密:false
     * @param string $key 加密密匙
     * @return string
     */
    function tcodes($string, $isEncrypt = true, $key = 'mime.org.cn')
    {
        $dynKey = $isEncrypt ? hash('sha1', microtime(true)) : substr($string, 0, 40);
        $dynKey1 = substr($dynKey, 0, 20);
        $dynKey2 = substr($dynKey, 20);
        $fixKey = hash('sha1', $key);
        $fixKey1 = substr($fixKey, 0, 20);
        $fixKey2 = substr($fixKey, 20);
        $newkey = hash('sha1', $dynKey1 . $fixKey1 . $dynKey2 . $fixKey2);
        if ($isEncrypt) {
            $newstring = $fixKey1 . $string . $dynKey2;
        } else {
            $newstring = base64_decode(substr($string, 40));
        }
        $re = '';
        $len = strlen($newstring);
        for ($i = 0; $i < $len; $i++) {
            $j = $i % 40;
            $re .= chr(ord($newstring{$i}) ^ ord($newkey{$j}));
        }
        return $isEncrypt ? $dynKey . str_replace('=', '_', base64_encode($re)) : substr($re, 20, -20);
    }
}