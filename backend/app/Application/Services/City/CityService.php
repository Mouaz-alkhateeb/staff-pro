<?php

namespace App\Application\Services\City;

use App\Domain\DTO\City\CreateCityDTO;
use App\Domain\DTO\City\UpdateCityDTO;
use App\Domain\Filter\City\CityFilter;
use App\Domain\Interfaces\City\CityServiceInterface;
use App\Infrastructure\Repository\City\CityRepository;

class CityService implements CityServiceInterface
{
    public function __construct(private CityRepository $cityRepository) {}

    public function createCity(CreateCityDTO $data)
    {
        return $this->cityRepository->create($data->toArray());
    }
    public function updateCity(int $id, UpdateCityDTO $data)
    {
        return $this->cityRepository->updateById($id, $data->toArray());
    }
    public function showCity(int $id)
    {
        return $this->cityRepository->getById($id);
    }

    public function deleteCity(int $id)
    {
        return $this->cityRepository->deleteById($id);
    }
    public function getCity()
    {
        return $this->cityRepository->paginate();
    }

    public function getCities(CityFilter $cityFilter = null)
    {
        if ($cityFilter != null)
            return $this->cityRepository->getFilterItems($cityFilter);
        else
            return $this->cityRepository->paginate();
    }
}
