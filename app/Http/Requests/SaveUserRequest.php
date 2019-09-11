<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SaveUserRequest extends FormRequest
{
    //Determine if the user is authorized to make this request.
    public function authorize()
    {
        return true;
    }



    //Get the validation rules that apply to the request.
    public function rules()
    {
        // return [ 'username'       => 'required|unique:users,username',
        //          'first_name'     => 'required|alpha',
        //          'last_name'      => 'required|alpha',
        //          'email'          => 'required|unique:users,email|email|',  //maybe add 'regex:/^.+@.+$/i'
        //          'password'       => 'required_with:password_confirmation|string|min:4|confirmed',
        //          'phone'          => 'nullable|numeric',
        //          'date_of_birth'  => 'required|date',
        //          'country_id'     => 'exists:countries,id',
        //          'province_id'    => 'exists:provinces,id',
        //          'sex_id'         => 'exists:sexes,id',
        //          'role_id'        => 'exists:roles,id',
        //          'user_status_id' => 'exists:user_statuses,id',
        //          'created_at'     => 'date',
        //          'updated_at'     => 'nullable|date',
        //          'deleted_at'     => 'nullable|date',
        // ];
        return [ 'username'       => 'unique:users,username',
        'first_name'     => 'alpha',
        'last_name'      => 'alpha',
        'email'          => 'unique:users,email|email|',  //maybe add 'regex:/^.+@.+$/i'
        'password'       => 'required_with:password_confirmation|string|min:4|confirmed',
        'phone'          => 'nullable|numeric',
        'date_of_birth'  => 'date',
        'country_id'     => 'exists:countries,id',
        'province_id'    => 'exists:provinces,id',
        'sex_id'         => 'exists:sexes,id',
        'role_id'        => 'exists:roles,id',
        'user_status_id' => 'exists:user_statuses,id',
        'created_at'     => 'date',
        'updated_at'     => 'nullable|date',
        'deleted_at'     => 'nullable|date',
];
    }



    //Get the error messages for the defined validation rules.
    public function messages()
    {
        return [
                 'required'       => 'Este campo es obligatorio.',
                 'string'         => 'Debe contener texto.',
                 'alpha'          => 'Este campo no puede contener números o símbolos.',
                 'numeric'        => 'Debe ser numérico.',
                 'min'            => 'Debe tener al menos :min caractéres.',
                 'max:100'        => 'No debe ser mayor a 100.',
                 'integer'        => 'Debe ser un número entero.',
                 'exists'         => 'No es un :attribute válido.',
                 'date'           => 'Debe ser una fecha válida.',
                 'file'           => 'Debe ser un archivo válido',
                 'mimes'          => 'Debe ser del tipo jpg, bmp o png.',
                 'dimensions'     => 'Debe ser de 2048 pixels como máximo y ser cuadrada.',
                 'unique'         => 'Este :attribute ya existe. Por favor elija otro.',
                 'confirmed'      => 'Las contraseñas no coinciden.',
                 'province_id.exists' => 'No es una :attribute válida.',
        ];
    }



   //Get custom attribute names for validator errors.
    public function attributes()
    {
        return [
                'username'       => 'nombre de usuario',
                'first_name'     => 'nombre',
                'last_name'      => 'apellido',
                'email'          => 'email',
                'password'       => 'contraseña',
                'phone'          => 'teléfono',
                'date_of_birth'  => 'fecha de nacimiento',
                'country_id'     => 'país',
                'province_id'    => 'provincia',
                'sex_id'         => 'sexo',
                'role_id'        => 'rol',
                'user_status_id' => 'estado',
                'created_at'     => 'creado',
                'updated_at'     => 'actualizado',
                'deleted_at'     => 'borrado',
        ];
    }



   //Configure the validator instance.
   //@param  \Illuminate\Validation\Validator  $validator
   //@return void
//   public function withValidator($validator)
//   {
//       $validator->after(function ($validator) {
//           if ($this->somethingElseIsInvalid()) {
//               $validator->errors()->add('field', 'Something is wrong with this field!');
//           }
//       });
//   }
}
