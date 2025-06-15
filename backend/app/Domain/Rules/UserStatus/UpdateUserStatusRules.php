<?php

namespace App\Domain\Rules\UserStatus;

class UpdateUserStatusRules
{
    public static function rules(): array
    {
        return [
            'name' => 'required'
        ];
    }
}