<?php

namespace App\Domain\Rules\Nationality;

use App\Domain\State\NationalityStatuses;
use Illuminate\Validation\Rule;

class UpdateNationalityRules
{
    public static function rules(): array
    {
        return [
            'name' => 'required',
            'status' => [Rule::in(NationalityStatuses::$statuses)]
        ];
    }
}