<?php

namespace App\Http\Controllers\Shop;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\Product;
use App\Models\Collection;
use App\Models\ProductCategory;
use App\Models\ProductVideo;
use Illuminate\Http\Request;
use App\Http\Requests;

/**
 * Class ShopController
 * @package App\Http\Controllers\Shop
 */
class ShopController extends Controller
{
    public function __construct()
    {
        //$this->middleware('wechat');
        //$this->middleware('access');
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        $categories = ProductCategory::all();
        $products = Product::where('category_id', $categories[0]->id)->get();
        return view('shop.index', ['categories' => $categories, 'products' => $products]);
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function getProductByCatID(Request $request)
    {
        if($request->input('cat_id'))
            $where = array('category_id'=>  $request->input('cat_id'));
        else
            $where =array();
        return response()->json(['products' => Product::where($where)->get()]);
    }

    /**
 * @param Request $request
 * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
 */
    public function detail(Request $request)
    {
        try {
            //$customer = \Helper::getCustomer();
            $customer = \App\Models\Customer::find(3);
            $id = $request->input('id');
            $data = Product::find($id);
            if($data)
                Product::find($id)->increment('view_counts');

            $tags = strtr($data->tags,",","|");
            $tags = $tags ? $tags : ' ';
            $data_similar = Product::orderBy('id','desc')->offset(0)->where('id', '<>', $id)->whereRaw("tags REGEXP '".$tags."'")->limit(4)->get();//相关商品
            $is_collect =false;// 验证是否收藏
            if ($customer) {
                //产品是否收藏
                if(Collection::where(['user_id'=> $customer->id,'product_id'=>$id])->first())
                    $is_collect = 1;
                else
                    $is_collect = 0;
            }
        }
        catch (\Exception $e) {
            abort(404);
        }

        return view('shop.detail')->with(['data' => $data,'data_similar' => $data_similar,'id'=>$id,'is_collect'=>$is_collect]);

    }

    /**
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function info(Request $request)
    {
        return view('shop.info', [
            // 'product' => $product,
            // 'collect' => ProductCollection::where('product_id', $request->input('id'))->where('customer_id', $customer->id)->get()->toArray() ? true : false
        ]);
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function createOrder(Request $request)
    {
        $customer = \Helper::getCustomer();

        $order = new Order();
        $order->customer_id = $customer->id;
        $order->product_id = $request->input('product_id');
        $order->phone = $request->input('phone');
        $order->remark = $request->input('remark');
        $order->order_sn = time();
        $order->save();
        return response()->json(['success' => true]);
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function cancelOrder(Request $request)
    {
        $customer = \Helper::getCustomer();
        Order::where('id', $request->input('id'))->where('customer_id', $customer->id)->delete();
        return response()->json(['success' => true]);
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function collect(Request $request)
    {
        $productID = $request->input('product_id');
        $customer = \Helper::getCustomer();
        \DB::transaction(function () use ($productID, $customer) {
            $product = Product::find($productID);
            $product->fans += 1;
            $product->save();

            $collection = new ProductCollection();
            $collection->product_id = $productID;
            $collection->customer_id = $customer->id;
            $collection->save();
        });
        return response()->json(['success' => true]);
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function cancelCollect(Request $request)
    {
        //TODO redis
        $productID = $request->input('product_id');
        $customer = \Helper::getCustomer();
        \DB::transaction(function () use ($productID, $customer) {
            $product = Product::find($productID);
            $product->fans -= 1;
            $product->save();

            ProductCollection::where('product_id', $productID)->where('customer_id', $customer->id)->delete();
        });
        return response()->json(['success' => true]);
    }

    /**
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function video(Request $request)
    {
        $video = ProductVideo::where('product_id', $request->input('product_id'))->get();
        $customer = \Helper::getCustomer();
        //\UCenter::updateBeans($customer->phone, 'video_view', '1');
        return view('shop.video', [
            'videos' => $video ? $video : []
        ]);
    }
} /*class*/
