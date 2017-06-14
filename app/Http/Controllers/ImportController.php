<?php

namespace App\Http\Controllers;
use App\Models\Customer;
use App\User;
use Illuminate\Http\Request;
use Overtrue\Wechat\Js;
class ImportController extends Controller
{

    public function index()
    {
        set_time_limit(0);
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
}

