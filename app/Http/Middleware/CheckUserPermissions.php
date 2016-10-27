<?php

namespace App\Http\Middleware;

use Closure;
use App\User;
use Illuminate\Support\Facades\Auth;
use Zizaco\Entrust\Traits\EntrustUserTrait;
use Illuminate\Support\Facades\Config;

class CheckUserPermissions
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
      
        $user = User::findOrFail(auth()->user()->id);
                     
        if($user->hasRole(Config::get('constants.REGULAR_USER')))
        {
           return Redirect('step1');
          
        }
        elseif(!$user->hasRole(Config::get('constants.BACKEND_ADMIN')) || 
              !$user->hasRole(Config::get('constants.CUSTOMER_ADMIN')) || 
              !$user->hasRole(Config::get('constants.SUPPORT_ADMIN')) || 
              !$user->hasRole(Config::get('constants.FULFILLMENT')))

        {
            return Redirect('admin/dashboard');
        }
        return $next($request);
    }
}
