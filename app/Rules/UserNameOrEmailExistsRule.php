<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;

class UserNameOrEmailExistsRule implements Rule
{
    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Determine if the validation rule passes.
     *
     * @param  string  $attribute
     * @param  mixed  $value
     * @return bool
     */
    public function passes($attribute, $value)
    {
        return \App\User::where('username', $value)->orWhere('email', $value)->first();
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'No existe un usuario con este nombre o email. Cree una nueva cuenta si lo desea.';
    }
}
