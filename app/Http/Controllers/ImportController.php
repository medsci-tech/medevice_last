<?php

namespace App\Http\Controllers;
use App\Models\Customers;
use App\User;

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
}

