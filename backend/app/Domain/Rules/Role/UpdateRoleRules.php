<?php

namespace App\Domain\Rules\Role;


class UpdateRoleRules
{
    public static function rules(): array
    {
        return [
            'permissions' => 'required|array',
        ];
    }
}
