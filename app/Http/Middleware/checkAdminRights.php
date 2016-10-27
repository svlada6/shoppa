<?php
use Illuminate\Support\Facades\Auth;
namespace App\Http\Middleware;
use Illuminate\Support\Facades\Config;

use Closure;

class checkAdminRights
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
       
        $actions = $request->route()->getAction();       
    
        $user = \App\User::findOrFail(auth()->user()->id);
        $admin_rights = $user->admin_rights()->get();
        //dd(($user->hasRole(Config::get('constants.BACKEND_ADMIN')) && $user->limit_access == 0));
        if(($user->hasRole(Config::get('constants.BACKEND_ADMIN')) && $user->limit_access == 0)
               
                ||($user->hasRole($actions['role']) && $user->limit_access == 0) 
                        
                || ($user->limit_access == 1 && $admin_rights->contains('name',$actions['admin_right']) ))
                
            return $next($request);
         else    
            abort(403);
     
                
        return $next($request);
    }
}
