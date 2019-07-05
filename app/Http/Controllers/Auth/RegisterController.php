<?php

namespace App\Http\Controllers\Auth;
use App\Cliente;
use App\User;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = '/home';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:6'],
            'username'=>["required","unique:users,username"],
            "medio_pago"=>['required','string'],
            'cedula'=>['required','unique:clientes,cedula',"numeric"],
            'contacto_emergencia'=>['required',"numeric"],
            'telefono'=>["required","numeric"]
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\User
     */
    protected function create(array $data)
    {
        //crear usuario general
        $user=User::create([
            'username' => $data['username'],
            'email' => $data['email'],
            'password' => bcrypt($data['password']),
            'telefono'=>$data["telefono"],
            'rol'=>0
        ]);
        if($user->wasRecentlyCreated == true){
        //crear cliente
         Cliente::create(["nombre"=>$data["name"],
            "cedula"=>$data["cedula"],
        "contacto_emergencia"=>$data["contacto_emergencia"],
        "medio_pago"=>$data["medio_pago"],
        "user_id"=>$user->id]);}
        return $user;
    }
}
