<?php 
    namespace App\Helpers;
    use \Illuminate\Support\Facades\Auth;
    use Illuminate\Support\Facades\Config;
     
    class Helper
    {
        public static function check($page, $role)
        {
     
            $user =Auth::user();
            $admin_rights = $user->admin_rights()->get();

         
            if(($user->roles[0]->name == $role && $user->limit_access == 0) || ($user->limit_access == 1 && $admin_rights->contains('name',$page) ) || ($user->roles[0]->name == Config::get('constants.BACKEND_ADMIN') && $user->limit_access == 0))
                return true;
                   else
                      return false;
        }
    }
    
?>