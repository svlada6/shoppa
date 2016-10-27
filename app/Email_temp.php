<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Email_temp extends Model
{
    protected  $fillable =['subject','content'];
    public function variables()
    {
        return $this->belongstoMany('App\Email_var');
    }
}
