<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Testemonial extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'testemonials';


    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'body', 'user_id','enabled','order'
    ];


    /**
     * Get the faq category that owns the faq.
     */
    public function users()
    {
        return $this->belongsTo('App\User');
    }
}
