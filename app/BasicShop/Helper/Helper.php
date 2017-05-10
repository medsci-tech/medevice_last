<?php

namespace App\BasicShop\Helper;

use App\Constants\AppConstant;
use App\Models\Customer;
use App\BasicShop\Exceptions\UserNotCachedException;
use App\BasicShop\Exceptions\UserNotSubscribedException;

/**
 * Class Helper
 * @package App\MedServer\Helper
 */
class Helper
{
    /**
     * @return mixed
     * @throws UserNotCachedException
     * @throws UserNotSubscribedException;
     */
    public function getSessionCachedUser()
    {
        if (!$this->hasSessionCachedUser()) {
            //throw new UserNotCachedException;
            return redirect('/register/create');
        }
        $user = \Session::get(AppConstant::SESSION_USER_KEY);

        if (is_null($user)) {
            //throw new UserNotSubscribedException;
            return redirect('/register/create');
        }
        return $user;
    }

    /**
     * @return bool
     */
    public function hasSessionCachedUser()
    {
        return \Session::has(AppConstant::SESSION_USER_KEY);
    }

    /**
     *
     *
     * @return array
     */
    public function getUser()
    {
        try {
            $user = \Helper::getSessionCachedUser();

            return $user;
        } catch (\Exception $e) {
            //abort('404');
            return redirect('/register/create');
        }
    }

    /**
     * @return \App\Models\Customer;
     */
    public function getCustomer()
    {
        $user = \Helper::getSessionCachedUser();
        $customer = Customer::where('openid', $user['openid'])->first();
        if ($customer && $customer->phone) {
            return $customer;
        } else {
            return redirect('/register/create');
        }
    }

}