<?php

namespace App\Application\Services\Nationality;

use App\Domain\DTO\Nationality\CreateNationalityDTO;
use App\Domain\DTO\Nationality\UpdateNationalityDTO;
use App\Domain\Filter\Nationality\NationalityFilter;
use App\Domain\Interfaces\Nationality\NationalityInterface;
use App\Infrastructure\Repository\Nationality\NationalityRepository;

class NationalityService implements NationalityInterface
{

    /**
     */
    public function __construct(
        private NationalityRepository $nationalityRepository
    ) {}

    public function createNationality(CreateNationalityDTO $data)
    {

        return $this->nationalityRepository->create($data->toArray());
    }

    public function updateNationality(int $id, UpdateNationalityDTO $data)
    {


        return $this->nationalityRepository->updateById($id, $data->toArray());
    }
    public function showNationality(int $id)
    {

        return $this->nationalityRepository->getById($id);
    }

    public function deleteNationality(int $id)
    {
        return $this->nationalityRepository->deleteById($id);
    }
    /**
     * @return mixed
     */
    public function getNationalities(NationalityFilter $nationalityFilter = null)
    {
        if ($nationalityFilter != null)
            return $this->nationalityRepository->getFilterItems($nationalityFilter);
        else
            return $this->nationalityRepository->paginate();
    }
}