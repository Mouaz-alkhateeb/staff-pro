<?php

namespace App\Domain\Action\City;

use App\Domain\DTO\City\UpdateCityDTO;

class UpdateCityAction
{
    public static function execute(UpdateCityDTO $updateCityDTO)
    {
        return $updateCityDTO;
    }
}
