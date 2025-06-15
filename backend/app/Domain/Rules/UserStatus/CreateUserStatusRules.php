<?php

namespace App\Domain\Rules\UserStatus;

class CreateUserStatusRules
{
    public static function rules(): array
    {
        return [
            'name' => 'required'
        ];
    }
}