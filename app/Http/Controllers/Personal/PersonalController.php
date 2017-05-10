<?php

namespace App\Http\Controllers\Personal;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\ProductCollection;
use App\Models\SupplierAttention;

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
        return view('personal.index', ['customer' => \Helper::getCustomer()]);
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
        $collections = ProductCollection::where('customer_id', $customer->id)->get();
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


} /*class*/
