<?php

namespace App\Http\Controllers\Apply;

use App\Http\Controllers\Controller;


/**
 * Class PersonalController
 * @package App\Http\Controllers\Personal
 */
class ApplyController extends Controller
{
    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        return view('apply.index', ['customer' => null]);
    }


} /*class*/
