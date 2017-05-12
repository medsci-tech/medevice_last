<?php

namespace App\Http\Middleware;

use App\Models\Customer;
use Closure;

class AccessMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \Closure $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $user = \Helper::getSessionCachedUser();
        $customer = Customer::where('openid', $user['openid'])->first();
        if ($customer && $customer->phone && $customer->password) {
            return $next($request);
        } else {
            return redirect('/register/create');
        }
    }

} /*class*/
