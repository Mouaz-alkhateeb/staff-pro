<?php

namespace App\Domain\Action\City;

use App\Domain\DTO\City\CreateCityDTO;
use App\Domain\State\CityStatuses;

class CreateCityAction
{
    public static function execute(CreateCityDTO $createCityDTO)
    {
        $createCityDTO->setStatus($createCityDTO->status ?? CityStatuses::ACTIVE_CITY);
        return $createCityDTO;
    }
}
