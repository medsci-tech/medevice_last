<?php

namespace App\Http\Controllers\Wechat;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class WechatController extends Controller
{
    public function serve(Request $request)
    {
        $server = \Wechat::getServer();
        $server->on('message', \Wechat::messageEventCallback());
        $server->on('event', 'subscribe', \Wechat::subscribeEventCallback());

        return $server->serve();
    }

    public function menu()
    {
        $ret = \Wechat::createMenu();
        if ($ret) {
            return 'Create Menu Success';
        } else {
            return 'Create Menu Failed';
        } /*else>*/
    }

} /*class*/
