<?php

namespace App\Http\Controllers\Auth;

use App\User;
use App\Sex;
use App\Role;
use App\User_status;
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

        $rules = [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
            'first_name' => ['required', 'string', 'max:50'],
            'last_name' => ['required', 'string', 'max:50'],
            'date_of_birth' => ['date'],
            'phone' => ['numeric'],
        ];

        $messages = [
            'required' => 'El campo :attribute es obligatorio.',
            'string' => ':El campo attribute debe ser una cadena de texto.',
            'max' => 'El campo :attribute no debe superar :max caracteres.',
            'min' => 'El campo :attribute debe tener al menos :min caracteres.',
            'confirmed' => ':attribute no coinciden.',
            'email' => 'El campo :attribute debe tener formato de mail.',
            'unique' => 'El campo :attribute ya se encuentra en la base.',
            'date' => 'El campo :attribute no corresponde a una fecha.',
            'numeric' => 'El campo :attribute no corresponde a un numero.',
        ];

        return Validator::make($data, $rules, $messages);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\User
     */
    protected function create(array $data)
    {
        return User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
            'first_name' => $data['first_name'],
            'last_name' => $data['last_name'],
            'phone' => $data['phone'],
            'date_of_birth' => $data['date_of_birth'],
            'sex_id' => $data['sex_id'],
            'user_status_id' => $data['user_status_id'],
            'role_id' => $data['role_id'],
        ]);
    }

    protected function showRegistrationForm() {

      $sexes = Sex::all();
      $roles = Role::all();
      $user_statuses = user_status::all();
       // dd($sexes);

      // return view('\auth\register')->with('sexes',$sexes);
      return view('/auth/register',compact('sexes','roles','user_statuses'));

    }
}
