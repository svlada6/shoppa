<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Zizaco\Entrust\EntrustPermission;

class Admin_right extends Model
{  

    public function users()
    {
        return $this->belongsToMany('App\User');
    }
}
