<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Zizaco\Entrust\EntrustPermission;

class Permission extends EntrustPermission
{
    public function users()
    {
        return $this->belongsToMany('App\User');
    }
}
