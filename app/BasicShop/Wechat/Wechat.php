<?php

namespace App\BasicShop\Wechat;

use App\Constants\AppConstant;
use App\Models\Customer;
use App\Models\CustomerType;
use Overtrue\Wechat\Server;
use Overtrue\Wechat\Message;
use Overtrue\Wechat\MenuItem;
use Overtrue\Wechat\Menu;
use Overtrue\Wechat\Auth;


class Wechat
{

    private $_appId;
    private $_secret;
    private $_aesKey;
    private $_token;

    function __construct()
    {
        $this->_appId   = env('WX_APPID');
        $this->_secret  = env('WX_SECRET');
        $this->_token   = env('WX_TOKEN');
        $this->_aesKey  = env('WX_ENCODING_AESKEY');
    }

    public function getServer()
    {
        return new Server($this->_appId, $this->_token, $this->_aesKey);
    }

    private function createMenuItem()
    {
        return [
            (new MenuItem("产品专区"))->buttons([
                new MenuItem('产品展示', 'view', url('/shop')),
                new MenuItem('入驻厂家', 'view', url('/supplier'))
            ]),
            (new MenuItem("专业培训"))->buttons([
                new MenuItem('视频讲堂', 'view', url('/video')),
                new MenuItem('最新资讯', 'view', url('/article'))
            ]),
            (new MenuItem("会员中心"))->buttons([
                new MenuItem('个人信息', 'view', url('/personal')),
                new MenuItem('关于我们', 'view', url('/about-us')),
                new MenuItem('售后电话', 'view', url('/phone'))
            ])
        ];

    }

    public function createMenu()
    {
        $menuService = new Menu($this->_appId, $this->_secret);
        $menus = $this->createMenuItem();
        try {
            $menuService->set($menus);
        } catch(\Exception $e) {
            return false;
        } /*catch>*/

        return true;
    }

    public function messageEventCallback() {
        return function ($message) {
        if (in_array($message->Content, array('邀请函','邀请'))) {
                return Message::make('text')->content("<a target=\"_blank\" href=\"http://g.eqxiu.com/s/948fHP3Q?eqrcode=1&from=singlemessage&isappinstalled=0\">第77届中国医疗器械博览会邀请函</a>");
         }
        if (in_array($message->Content, array('产品'))) {
            return Message::make('text')->content("<a target=\"_blank\" href=\"http://medevice-tech.com/shop\">查看优质药械产品详情</a>");
        }
        if (in_array($message->Content, array('历史'))) {
            return Message::make('text')->content("<a target=\"_blank\" href=\"https://mp.weixin.qq.com/mp/profile_ext?action=home&__biz=MzAwMTc3MDY4NA==&scene=124\">查看历史咨询</a>");
        }
            return Message::make('text')->content('您好!');
        };
    }

    public function subscribeEventCallback()
    {
        return function ($event) {
            \Log::info('subscribe' . $event);
            $openId = $event['FromUserName'];
            $customer = Customer::where('openid', $openId)->first();
            if ($customer) {

                return Message::make('text')->content("欢迎关注药械通！\n\n回复“产品”查看优质药械产品详情 \n\n回复“历史”查看历史咨询\n\n回复“邀请函”查看第77届中国医疗器械博览会邀请函");
                //return Message::make('text')->content('欢迎您回来!');
            }
            return Message::make('text')->content("欢迎关注药械通！\n\n回复“产品”查看优质药械产品详情 \n\n回复“历史”查看历史咨询\n\n回复“邀请函”查看第77届中国医疗器械博览会邀请函");
           // return Message::make('text')->content('嗨!欢迎关注药械通!');
        };
    }

    /**
     * @param string $jump_url
     * @return null|\Overtrue\Wechat\Utils\Bag
     */
    public function authorizeUser($jump_url)
    {
        $appId = $this->_appId;
        $secret = $this->_secret;
        $auth = new Auth($appId, $secret);
        $result = $auth->authorize(url($jump_url), 'snsapi_base,snsapi_userinfo');

        \Session::put('web_token', $result->get('access_token'));
        return $auth->getUser($result->get('openid'), $result->get('access_token'));

//        $appId = $this->_appId;
//        $secret = $this->_secret;
//        $auth = new Auth($appId, $secret);
//
//        $result = $auth->authorize(url($jump_url), 'snsapi_base,snsapi_userinfo');
//        \Log::debug('result', ['result' => serialize($result)]);;
//        return $result;
    }

} /*class*/