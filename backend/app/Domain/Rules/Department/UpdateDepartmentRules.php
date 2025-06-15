<?php

namespace App\Domain\Rules\Department;

use App\Domain\State\DepartmentStatuses;
use Illuminate\Validation\Rule;

class UpdateDepartmentRules
{
    public static function rules(): array
    {
        return [
            'name' => 'required',
            'status' => [Rule::in(DepartmentStatuses::$statuses)]
        ];
    }
}