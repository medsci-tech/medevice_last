<?php

namespace App\Http\Controllers\Apply;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Apply;
/**
 * Class PersonalController
 * @package App\Http\Controllers\Personal
 */
class ApplyController extends Controller
{
    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index(Request $request)
    {
        if ($request->isMethod('post')) {
            $data = $request->all();                Apply::firstOrCreate($data);
            return response()->json(['code'=>200, 'status' => 1,'message' => '登记成功' ]);
            try {
                if($data['real_name'==''])
                    return response()->json(['code' => 200, 'status' => 0, 'message' => '姓名不能为空!']);
                if($data['phone'==''])
                    return response()->json(['code' => 200, 'status' => 0, 'message' => '联系电话不能为空!']);

                Apply::firstOrCreate($data);
                return response()->json(['code'=>200, 'status' => 1,'message' => '登记成功' ]);

            } catch (\Exception $e) {
                return response()->json(['code' => 200, 'status' => 0, 'message' => '服务器异常!']);
            }
        }
        return view('apply.index');
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function success(Request $request)
    {
        return view('apply.success', ['customer' => null]);
    }

} /*class*/
