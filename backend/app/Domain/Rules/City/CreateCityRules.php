<?php

namespace App\Domain\Rules\City;

use App\Domain\State\CityStatuses as StateCityStatuses;
use Illuminate\Validation\Rule;

class CreateCityRules
{
    public static function rules(): array
    {
        return [
            'name' => 'required',
            'status' => [Rule::in(StateCityStatuses::$statuses)]
        ];
    }
}
