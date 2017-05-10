<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Customer;

class TestController extends Controller
{
    public function export()
    {
        $customers = Customer::all();
        $array = [];
        foreach ($customers as $customer) {
            array_push($array, $customer->phone);
        }
        $string = json_encode($array);
        echo $string;
        echo '<hr/>';
        echo json_decode($string);
        echo '<hr/>';
        dd($string);
    }
}
