<?php

namespace App\Http\Requests\Interfaces;
use App\Http\Requests\Request;
/**
 * @mixin Request
 */
trait CheckCollection
{
    /**
     * 收藏产品验证
     * @author      lxhui<772932587@qq.com>
     * @since 1.0
     * @return array
     */
    public function checkCollection(array $data=[])
    {
        $rules = [
            'product_id' => 'required|exists:products,id',
            'action' => 'boolean',
           // 'action' => 'required|in:add,cancel',
        ];
        $messages = [
            'product_id.required' => '商品id不能为空',
            'action.required' => 'action不能为空',
            'action.boolean' => 'action接收 1或0',
            'product_id.exists' => '商品id不存在',
        ];
        try {
            $customer = \Helper::getCustomer();
            $user_id = $customer->id;
            if(!$user_id)
                return ['code'=>200, 'status' => 0,'message' => '请先登录!' ];

            $validator = \Validator::make($data, $rules, $messages);
            $validator_error_first = $validator->errors()->first();
            if($validator_error_first)
                return ['code'=>200, 'status' => 0,'message' => $validator_error_first ];

            $save_date = ['user_id'=>$user_id,'product_id'=>$data['product_id']];
            $model = \App\Models\Collection::where($save_date)->first();
            if($data['action']) // 收藏
                $res = \App\Models\Collection::firstOrCreate($save_date);
            else //取消收藏
                if($model)
                    $model->delete();
            return ['code'=>200, 'status' => 1,'message' => '收藏成功!' ];
        }
        catch (\Exception $e) {
            return ['code' => 200, 'status' => 0, 'message' => $e->getMessage()];
        }

    }

}