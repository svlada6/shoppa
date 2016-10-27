<?php

namespace App;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Laravel\Cashier\Billable;
use Zizaco\Entrust\Traits\EntrustUserTrait;

class User extends Authenticatable
{
    use EntrustUserTrait;
   // use Billable;
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];


    /**
     * Get the posts for the user.
     */
    public function getPostsList()
    {
        return $this->hasMany('App\Post');
    }
    
    public function admin_rights()
    {
        return $this->belongsToMany('App\Admin_right');
    }

    public function shipping_informations()
    {
        return $this->hasOne('App\Shipping_information');
    }

    public function billing_informations()
    {
        return $this->hasOne('App\Billing_information');
    }
}
