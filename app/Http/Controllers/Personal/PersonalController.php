<?php

namespace App\Http\Controllers\Personal;

use App\Http\Controllers\Controller;
use App\Models\Customer;
use App\Models\Order;
use App\Models\Message;
use App\Models\Collection;
use App\Models\Appointment;
use App\Models\SupplierAttention;
use Illuminate\Http\Request;
use Overtrue\Wechat\Js;
/**
 * Class PersonalController
 * @package App\Http\Controllers\Personal
 */
class PersonalController extends Controller
{

    public function __construct()
    {
        $this->middleware('wechat');
        $this->middleware('access');
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        $customer = \Helper::getCustomer();
        //$customer = Customer::find(15);
        return view('personal.index', ['customer' => $customer]);
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function orderList()
    {
        $customer = \Helper::getCustomer();
        $orders = Order::where('customer_id', $customer->id)->get();
        return view('personal.order-list', ['orders' => $orders]);
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function collectionList()
    {
        $customer = \Helper::getCustomer();
        //$customer = Customer::find(15);
        $collections = Collection::where('user_id', $customer->id)->get();
        return view('personal.collection-list', ['collections' => $collections]);
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function attentionList()
    {
        $customer = \Helper::getCustomer();
        $attentions = SupplierAttention::where('customer_id', $customer->id)->get();
        return view('personal.attention-list', ['attentions' => $attentions]);
    }
    /**
     * 个人资料修改
     * @author      lxhui<772932587@qq.com>
     * @since 1.0
     * @return array
     */
    public function infoEdit(Request $request)
    {
        $customer = \Helper::getCustomer();
        //$customer = Customer::find(15);
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
        return view('personal.info-edit', ['customer' => $customer,'js' => $js]);
    }

    /**
     * 个人专长
     * @author      lxhui<772932587@qq.com>
     * @since 1.0
     * @return array
     */
    public function expertise(Request $request)
    {
        if ($request->isMethod('post')) {

            $data = $request->all();
            $data['real_name']=\Auth::user()->real_name;
            $data['province']=\Auth::user()->province;
            $data['city']=\Auth::user()->city;
            $data['sex']=\Auth::user()->sex;
            $data['email']=\Auth::user()->email;
            $result =$this->checkAgent($data);
            $data['user_id'] = \Auth::id();

            try {
                if($result['status'] ==1)
                {
                    /* 扩展科室 */
                    $depart_ids_arr = json_decode($request->depart_ids,true);
                    if(is_array($depart_ids_arr))
                    {
                        foreach($depart_ids_arr as $val)
                            OrderDepart::firstOrCreate(['depart_id' => $val['depart_id'],'user_id'=>\Auth::id()]);
                    }
                    /* 扩展服务 */
                    $service_type_ids_arr = json_decode($request->service_type_ids,true);
                    if(is_array($service_type_ids_arr))
                    {
                        foreach($service_type_ids_arr as $val)
                            OrderService::firstOrCreate(['service_type_id' => $val['service_type_id'],'user_id'=>\Auth::id()]);
                    }
                    /* 扩展医院 */
                    $hospitals_arr = json_decode($request->hospitals,true);
                    if(is_array($hospitals_arr))
                    {
                        foreach($hospitals_arr as $val)
                        {
                            $model = Hospital::firstOrCreate(['province'=>$val['province'],'city'=>$val['city'],'hospital'=>$val['hospital']]);
                            $hospital_id = $model->id;
                            OrderHospital::firstOrCreate(['hospital_id' => $hospital_id,'user_id'=>\Auth::id()]);
                        }
                    }
                    return response()->json(['code'=>200, 'status' => 1,'message' => '修改成功' ]);
                }
                else
                    return response()->json(['code'=>200, 'status' => 0,'message' => $result['message'] ]);

            } catch (\Exception $e) {
                return response()->json(['code' => 200, 'status' => 0, 'message' => '服务器异常!']);
            }
        }
        return view('personal.expertise', ['data' => null]);
    }

    /**
     * 企业证书
     * @author      lxhui<772932587@qq.com>
     * @since 1.0
     * @return array
     */
    public function enterprise(Request $request)
    {
        if ($request->isMethod('post')) {
            $file_id = $request->file_id;
            if(!$file_id)
                return response()->json(['code'=>200, 'status' => 0,'message' => '缺少file_id参数' ]);

            $file = $request->file('Filedata');
            if ($file->isValid()) {
                $url = \Helper::qiniuUpload($request->file('Filedata'));
                if($url)
                {
                    $model = CompanyImage::where(['user_id' => \Auth::id()])->first();
                    if($model)
                        CompanyImage::where(['user_id' => \Auth::id()])->update(['file_'.$file_id => $url]);
                    else
                        CompanyImage::create(['user_id'=>\Auth::id(),'file_'.$file_id => $url]);
                }
                else
                    return response()->json(['code'=>200, 'status' => 0,'message' => '上传失败' ]);

                return response()->json(['code'=>200, 'status' => 1,'message' => '上传成功','data'=>['url'=>$url.'?imageView2/1/w/150/h/150/q/90'] ]);
            } else
                return response()->json(['code'=>200, 'status' => 0,'message' => '上传失败' ]);
        }
//        $data = CompanyImage::where(['user_id'=> \Auth::id()])->first();
//        if($data)
//            $data = $data->toArray();
//        else
//            $data=[];

        return view('personal.enterprise', ['data' => null]);
    }

    /**
     * 我的消息
     * @author      lxhui<772932587@qq.com>
     * @since 1.0
     * @return array
     */
    public function message(Request $request)
    {
        $customer = \Helper::getCustomer();
        //$customer = Customer::find(15);
        $list = Message::orderBy('created_at','desc')->where(['user_id'=>$customer->id])->orWhere(['user_id'=>0])->get();
        return view('personal.message', ['list' => $list]);
    }

    /**
     * 个人合作列表
     * @author      lxhui<772932587@qq.com>
     * @since 1.0
     * @return array
     */
    public function cooperation()
    {
        $customer = \Helper::getCustomer();
        //$customer = Customer::find(15);

        $list = $customer->cooperationsWithProducts()->orderBy('id','desc')->get();
        return view('personal.cooperation', ['list' => $list]);
    }

    /**
     * 预约列表
     * @author      lxhui<772932587@qq.com>
     * @since 1.0
     * @return array
     */
    public function appointment(Request $request)
    {
        $customer = \Helper::getCustomer();
        //$customer = Customer::find(15);
        $status = $request->id;
        $where= ['status'=>$status,'user_id'=>$customer->id];
        if($status===NULL)
            unset($where['status']);

        $count_arr = Appointment::select(\DB::raw('count(*) as count,status'))->where(['user_id'=>$customer->id])->groupBy('status')->get()->toArray();
        $count_list= array_column($count_arr, 'count', 'status');
        $count = array_sum($count_list); //总数
        $list = Appointment::where($where)->get();
        return view('personal.appointment', compact('list','count','count_list','status'));
    }

} /*class*/
