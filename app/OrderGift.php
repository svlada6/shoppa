<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class OrderGift extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'order_gifts';


    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'first_name',
        'last_name',
        'email',
        'note',
        'order_id',
    ];


    public function order()
    {
        return $this->belongsTo('App\Order');
    }
}