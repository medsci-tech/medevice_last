<?php

namespace App\Http\Middleware;

use Closure;
use App\Constants\AppConstant;

class WechatMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if (\Helper::hasSessionCachedUser()) {
            return $next($request);
        }

        $user = \Wechat::authorizeUser($request->url());
        /*
         * if auth failed, this user maybe not a subscribed account,
         * but we allow this man go on to education page.
         * */
        if ($user) {
            \Session::put(AppConstant::SESSION_USER_KEY, $user->all());
        }

        return $next($request);
    }

} /*class*/
