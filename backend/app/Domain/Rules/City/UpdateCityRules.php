<?php

namespace App\Domain\Rules\City;

use App\Domain\State\CityStatuses;
use Illuminate\Validation\Rule;

class UpdateCityRules
{
    public static function rules(): array
    {
        return [
            'name' => 'required',
            'status' => [Rule::in(CityStatuses::$statuses)]
        ];
    }
}
