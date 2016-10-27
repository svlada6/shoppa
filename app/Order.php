<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Order extends Model
{
    use SoftDeletes;
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'orders';


    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        
        'user_id',
        'subscription_id',
        'name',
        'price',
        'package',
        'shipping_first_name',
        'shipping_last_name',
        'shipping_company',
        'subtotal',
        'shipping_company',
        'shipping_address_1',
        'shipping_address_2',
        'shipping_city',
        'shipping_state',
        'shipping_postal',
        'billing_first_name',
        'billing_last_name',
        'billing_company',
        'billing_address_1',
        'billing_address_2',
        'billing_city',
        'billing_state',
        'billing_postal',
        'shipping_state_id',
        'billing_state_id',
        'is_gift'
    
    ];
    

    public function products()
    {
        return $this->belongsToMany('App\Product')->withPivot('quantity', 'name', 'collection');
    }

    public function users()
    {
        return $this->belongsToMany('App\User');
    }

    public function subscriptions()
    {
        return $this->belongsToMany('App\Subscription');
    }

    public function collections()
    {
        return $this->belongsToMany('App\Collection')->withPivot('quantity', 'name');
    }

    public function gifts()
    {
        return $this->hasMany('App\OrderGift');
    }
}