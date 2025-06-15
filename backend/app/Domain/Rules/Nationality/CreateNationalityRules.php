<?php

namespace App\Domain\Rules\Nationality;

use App\Domain\State\NationalityStatuses;
use Illuminate\Validation\Rule;

class CreateNationalityRules
{
    public static function rules()
    {
        return [
            'name' => 'required',
            'status' => [Rule::in(NationalityStatuses::$statuses)]
        ];
    }
}