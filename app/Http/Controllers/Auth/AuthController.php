<?php

namespace App\Http\Controllers\Auth;

use App\User;
use App\Role;
use Validator;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\ThrottlesLogins;
use Illuminate\Foundation\Auth\AuthenticatesAndRegistersUsers;
use Illuminate\Support\Facades\Config;
use App\Email_temp;
use Illuminate\Support\Facades\Mail;

class AuthController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Registration & Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users, as well as the
    | authentication of existing users. By default, this controller uses
    | a simple trait to add these behaviors. Why don't you explore it?
    |
    */

    use AuthenticatesAndRegistersUsers, ThrottlesLogins;

    /**
     * Where to redirect users after login / registration.
     *
     * @var string
     */
    protected $redirectTo = '/login_home';

    // protected $loginPath = '/admin/login';

    /**
     * Create a new authentication controller instance.
     *
     * @return void
     */
    public function __construct()
    {
       // $this->middleware('guest', ['except' => 'logout']);
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        $message = [
           'name.required' => 'Ime i prezime su obavezni',
           'email.required' => 'Email adresa je obavezna',
           'email.unique' => 'Email adresa već postoji u sistemu',
           'email.email' => 'Email adresa nije u ispravnom formatu',
           'password.required' => 'Šifra je obavezna',
           'password.confirmed' => 'Unete šifre se ne slažu',
        ];
        
        return Validator::make($data, [
            'name' => 'required|max:255',
            'email' => 'required|email|max:255|unique:users',
            'password' => 'required|confirmed|min:6',
        ],$message);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return User
     */
    protected function create(array $data)
    {
        $user =  User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => bcrypt($data['password']),
        ]);
        
         $role = Role::where( 'name', '=', 'Regular user' )->first();
   
         $user->attachRole($role);
         
        $data = Email_temp::where('name','=','registration')->first();
       
       if($data)
       {
            $variables = $data->variables;

            $test_data['customer']     = $user->name;
        

            if ($variables->first())
            {      
                foreach ($variables as $var)
                {
                    if (isset($test_data[$var->name]))
                    {
                        $stringtoreplace[] = '%#'.$var->name.'#%';
                        $replace[]         = $test_data[$var->name];
                    }
                }
          
                $template['data'] = str_replace($stringtoreplace, $replace,
                    $data->content);
                $subject          = str_replace($stringtoreplace, $replace,
                    $data->subject);
            }
            else
            {
                $template['data'] = $data->content;
                $subject          = $data->subject;
            }

            Mail::send('admin.emails.template', $template,
                function($message) use($subject,$user) {
                $message->to($user->email, 'Test Mail')->subject($subject)->from(Config::get('constants.TEST_EMAIL'));
            });
    }
       
        return $user;
    }
    
    
}
