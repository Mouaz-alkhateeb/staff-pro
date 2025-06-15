<?php

namespace App\Domain\Interfaces\City;

use App\Domain\DTO\City\CreateCityDTO;
use App\Domain\DTO\City\UpdateCityDTO;
use App\Domain\Filter\City\CityFilter;

interface CityServiceInterface
{
    public function createCity(CreateCityDTO $data);
    public function updateCity(int $id, UpdateCityDTO $data);
    public function showCity(int $id);
    public function deleteCity(int $id);
    public function getCities(CityFilter $cityFilter);
}