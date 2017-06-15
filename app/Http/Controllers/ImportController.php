<?php

namespace App\Http\Controllers;
use App\Models\Customer;
use App\User;
use Illuminate\Http\Request;
use Overtrue\Wechat\Js;
use Overtrue\Wechat\AccessToken;
class ImportController extends Controller
{

    public function index()
    {
        set_time_limit(0);
        echo $this->tocurl('http://yxt.mime.org.dev/test',array('id'=>235,'title'=>'php模拟发送get和post请求'),1);

        exit;


        $list = Customers::all();

       foreach($list as $val)
       {
           $model = new User();
           if(!$model->where(['phone'=>$val->phone])->first())
           {
               $model->name = $val->phone;
               $model->phone = $val->phone;
               $model->openid= $val->openid;
               $model->password = bcrypt('12345678');
               $model->nickname = $val->nickname;
               $model->head_image_url =$val->head_image_url;
               $model->created_at =$val->created_at;
               $model->updated_at =$val->updated_at;
               $model->save();
               echo($val->phone).'导入ok<br>';
           }

       }
    }

    /**
     * 个人资料修改
     * @author      lxhui<772932587@qq.com>
     * @since 1.0
     * @return array
     */
    public function infoEdit(Request $request)
    {
        //$customer = \Helper::getCustomer();
        $customer = Customer::find(305);
        if ($request->isMethod('post')) {
            $data = array_filter([
                'real_name'=>$request->real_name,
                'sex'=>$request->sex,
                'email'=>$request->email,
                'birthday'=>$request->birthday,
                'province'=>$request->province,
                'city'=>$request->city,
                'area'=>$request->area
            ]);
            if($data)
            {
                $customer->update($data);
                return response()->json(['code'=>200, 'status' => 1,'message' => '修改成功' ]);
            }
            else
                return response()->json(['code'=>200, 'status' => 0,'message' => '缺少参数']);
        }
        $appId = env('WX_APPID');
        $secret = env('WX_SECRET');
        $js = new Js($appId, $secret);
        return view('personal.info-edit2', ['customer' => $customer,'js' => $js]);
    }

    /**
     * 发送数据
     * @param String $url     请求的地址
     * @param int  $method 1：POST提交，0：get
     * @param Array  $data POST的数据
     * @return String
     * @author  lxhui
     */
    public static function tocurl($url, $data,$method =0){
        $headers = array(
            "Content-type: application/json;charset='utf-8'",
            "Authorization: Bearer " . env('MD_USER_API_TOKEN'),
            "Accept: application/json",
            "Cache-Control: no-cache","Pragma: no-cache",
        );
        try {
            $ch = curl_init($url);
            curl_setopt($ch, CURLOPT_TIMEOUT, 60); //设置超时
            if(0 === strpos(strtolower($url), 'https')) {
                curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0); //对认证证书来源的检查
                curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0); //从证书中检查SSL加密算法是否存在
            }
            //设置选项，包括URL
            if($method) // post提交
            {
                curl_setopt($ch, CURLOPT_POST,  True);
                curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));
            }
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
            curl_setopt($ch, CURLOPT_HEADER, 0);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
            curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
            //执行并获取HTML文档内容
            $output = curl_exec($ch);
            $httpCode = curl_getinfo($ch,CURLINFO_HTTP_CODE);
            //释放curl句柄
            curl_close($ch);
            $response =json_decode($output,true);
            $response['httpCode'] = $httpCode;
        }
        catch (\Exception $e){
            $response = ['httpCode'=>500];
        }
        return $response;
    }
}

