<?php


namespace App\BasicShop\UCenter\Facades;

use Illuminate\Support\Facades\Facade;

class UCenter extends Facade
{
    protected static function getFacadeAccessor()
    {
        return 'ucenter';
    }
}