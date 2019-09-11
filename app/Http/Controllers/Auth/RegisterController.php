<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Auth\Events\Registered;
use App\Http\Requests\SaveUserRequest;
use Illuminate\Http\Request;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;
use PhpParser\Node\Expr\Ternary;

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

    //Where to redirect users after registration. @var string
    protected $redirectTo = '/';


    //Create a new controller instance. @return void
    public function __construct()
    {
        $this->middleware('guest');
    }



   //Handle a registration request for the application. @param  \Illuminate\Http\Request  $request
   //                                                   @return \Illuminate\Http\Response
    public function register(SaveUserRequest $request)
    {
        event(new Registered($user = $this->create($request)));

        $this->guard()->login($user);

        return $this->registered($request, $user)
            ?: redirect($this->redirectPath());
    }



    //Get a validator for an incoming registration request. @param  array  $data @return \Illuminate\Contracts\Validation\Validator
    // protected function validator(array $data)
    // {

    //     $rules = [
    //         'name'          => ['required', 'string', 'max:255'],
    //         'email'         => ['required', 'string', 'email', 'max:255', 'unique:users'],
    //         'password'      => ['required', 'string', 'min:8', 'confirmed'],
    //         'first_name'    => ['required', 'alpha', 'max:50'],
    //         'last_name'     => ['required', 'alpha', 'max:50'],
    //         'date_of_birth' => ['date'],
    //         'phone'         => ['numeric'],
    //     ];

    //     $messages = [
    //         'required'  => 'El campo :attribute es obligatorio.',
    //         'string'    => 'El campo :attribute debe ser una cadena de texto.',
    //         'alpha'     => 'El campo :attribute no puede contener números.',
    //         'max'       => 'El campo :attribute no debe superar :max caracteres.',
    //         'min'       => 'El campo :attribute debe tener al menos :min caracteres.',
    //         'confirmed' => 'El :attribute no coincide.',
    //         'email'     => 'El campo :attribute debe tener formato de mail.',
    //         'unique'    => 'El campo :attribute ya se encuentra en la base.',
    //         'date'      => 'El campo :attribute no corresponde a una fecha.',
    //         'numeric'   => 'El campo :attribute no corresponde a un numero.',
    //     ];

    //     return Validator::make($data, $rules, $messages);
    // }



    //Create a new user instance after a valid registration. @param  array  $data @return \App\User
    protected function create(SaveUserRequest $data)
    {
        return \App\User::create([
            'username'       => $data['username'],
            'first_name'     => $data['first_name'],
            'last_name'      => $data['last_name'],
            'email'          => $data['email'],
            'password'       => bcrypt($data['password']), //Hash::make($data['password']),
            'phone'          => $data['phone'],
            'date_of_birth'  => $data['date_of_birth'],
            'province_id'    => $data['province_id'],
            'sex_id'         => $data['sex_id'],
            'user_status_id' => 1,
            'role_id'        => 2,
        ]);
    }



    protected function showRegistrationForm() {

      $sexes = \App\Sex::all();
      $provinces = \App\Province::all();
      $countries = \App\Country::all();

      return view('/auth/register', compact('sexes','provinces','countries'));

    }
}
