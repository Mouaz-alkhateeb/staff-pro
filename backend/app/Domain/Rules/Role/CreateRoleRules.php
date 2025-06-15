<?php

namespace App\Domain\Rules\Role;

class CreateRoleRules
{
    public static function rules(): array
    {
        return [
            'name' => 'required',
            'display_name' => 'required',
            'description' => 'min:5',
        ];
    }
}
