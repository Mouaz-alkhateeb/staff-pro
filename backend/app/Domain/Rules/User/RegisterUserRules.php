<?php

namespace App\Domain\Rules\User;

class RegisterUserRules
{
    public static function rules(): array
    {

        return [
            'first_name' => 'string|required',
            'last_name' => 'string|required',
            'password' => 'required|max:40|min:6',
            'phone_number' => 'required|unique:users,phone_number',
        ];
    }
}