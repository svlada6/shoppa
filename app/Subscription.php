<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\File;

class Subscription extends Model
{
    protected $table = 'subscriptions';

    
    public function orders()
    {
        return $this->belongsToMany('App\Orders');
    }


}
