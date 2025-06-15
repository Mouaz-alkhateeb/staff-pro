<?php

namespace App\Domain\Rules\Department;

use App\Domain\State\DepartmentStatuses;
use Illuminate\Validation\Rule;

class CreateDepartmentRules
{
    public static function rules(): array
    {
        return [
            'name' => 'required',
            'status' => ['sometimes', Rule::in(DepartmentStatuses::$statuses)]
        ];
    }
}