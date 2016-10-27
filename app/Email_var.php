<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Email_var extends Model
{
      public function templates()
    {
        return $this->belongstoMany('App\Email_temp');
    }
}
