<?php

namespace App\Http\Controllers\Register;

use App\Models\Customer;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Overtrue\Wechat\Js;


/**
 * Class RegisterController
 * @package App\Http\Controllers\Register
 */
class RegisterController extends Controller
{
    /**
     *
     */
    function __construct()
    {
        //$this->middleware('wechat');
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function create()
    {
        return view('register.create');
    }


    /**
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function store(Request $request)
    {
        $messages = array(
            'phone.required' => '手机号不能为空',
            'phone.digits' => '手机格式不正确',
            'phone.phone' => '手机格式不正确',
            'phone.unique' => '手机号已注册',
            'code.required' => '验证码不能为空',
            'code.digits' => '验证码格式不正确'
        );
        $validator = \Validator::make($request->all(), [
            'phone' => 'required|digits:11|unique:customers,phone',
            'code' => 'required|digits:6',
        ], $messages);
        if ($validator->fails()) {
            return view('register.create', ['errors' => $validator->errors(), 'input' => $request->all()]);
        }
        $result = \MessageSender::checkVerify($request->input('phone'), $request->input('code'));
        if ($result) {
            $user = \Helper::getUser();
            $customer = new Customer();
            $customer->phone = $request->input('phone');
            $customer->type_id = 1;
            $customer->openid = $user['openid'];
            //$customer->nickname = $user['nickname'];
            //$customer->head_image_url = $user['headimgurl'];
            $customer->save();
            $appId = env('WX_APPID');
            $secret = env('WX_SECRET');
            $js = new Js($appId, $secret);
            return view('register.success', ['js' => $js]);
        } else {
            $validator->errors()->add('code', '验证码错误');
            return view('register.create', ['errors' => $validator->errors(), 'input' => $request->all()]);
        }
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function sendMessage(Request $request)
    {
        $verifyID = \MessageSender::createMessageVerify($request->input('phone'));
        return response()->json(['success' => true, 'data' => ['verify_id' => $verifyID]]);
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function setPwdForm()
    {
        return view('register.set-pwd');
    }

    /**
     * @param Request $request
     * @return bool|\Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function setPwd(Request $request)
    {
        $messages = array(
            'password.required' => '密码不能为空',
        );
        $validator = \Validator::make($request->all(), [
            'password' => 'required'
        ], $messages);
        if ($validator->fails()) {
            return view('register.set-pwd', ['errors' => $validator->errors(), 'input' => $request->all()]);
        }

        $customer = \Helper::getCustomer();
        $result = \UCenter::setPwd($customer->phone, $request->input('password'));
        if ($result) {
            $appId = env('WX_APPID');
            $secret = env('WX_SECRET');
            $js = new Js($appId, $secret);
            return view('register.set-success', ['js' => $js]);
        } else {
            return false;
        }
    }
}



