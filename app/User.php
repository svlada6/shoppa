<?php

namespace App;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Laravel\Cashier\Billable;
use Zizaco\Entrust\Traits\EntrustUserTrait;
use App\Role;
use Validator;
use Illuminate\Support\Facades\Config;

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
  
    /**
     * Regiser new user
     * @param type $data
     * @return type
     */
    public function createUser(array $data)
    {
        $user =  User::create([
                    'name'     => $data['name'],
                    'email'    => $data['email'],
                    'password' => bcrypt($data['password']),
        ]);       
        $role = Role::where('name', '=', Config::get('constants.REGULAR_USER'))->first();  
        $user->attachRole($role);
        return $user;
    }
    
    public function validateRegistredUser(array $data)
    {
        $message = [
           'name.required'      => 'Ime i prezime su obavezni',
           'email.required'     => 'Email adresa je obavezna',
           'email.unique'       => 'Email adresa već postoji u sistemu',
           'email.email'        => 'Email adresa nije u ispravnom formatu',
           'password.required'  => 'Šifra je obavezna',
           'password.confirmed' => 'Unete šifre se ne slažu',
           'password.min'        => 'Šifra mora biti najmanje 6 karaktera'
        ];
        
        return Validator::make($data, [
            'name'              => 'required|max:255',
            'email'             => 'required|email|max:255|unique:users',
            'password'          => 'required|confirmed|min:6',
        ],$message);
    }
    /*
     *Redirect user login due user roles 
     * 
     */
    public function loginUser()
    {
        $auth = auth()->user()->id;
        $user = User::findOrFail($auth);
        if($user->hasRole(Config::get('constants.BACKEND_ADMIN'))  ||
           $user->hasRole(Config::get('constants.CUSTOMER_ADMIN')) ||
           $user->hasRole(Config::get('constants.SUPPORT_ADMIN'))  ||
           $user->hasRole(Config::get('constants.FULFILLMENT'))
          )
        {
            $redirect = 'admin/dashboard';
        }
        else
        {
           $redirect = '/';
        }
        return $redirect;
    }
}
