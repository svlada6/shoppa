<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

    class Billing_information extends Model
{
    protected $fillable =['first_name','last_name','company','address_1','city','address_2','postal','user_id'];
    
    public function user()
    {
        return $this->belongsTo('App\User');
    }
}
