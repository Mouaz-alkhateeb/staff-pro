<?php

namespace App\Domain\Interfaces\Nationality;

use App\Domain\DTO\Nationality\CreateNationalityDTO;
use App\Domain\DTO\Nationality\UpdateNationalityDTO;
use App\Domain\Filter\Nationality\NationalityFilter;

interface NationalityInterface
{
    public function createNationality(CreateNationalityDTO $data);
    public function updateNationality(int $id, UpdateNationalityDTO $data);
    public function deleteNationality(int $id);
    public function showNationality(int $id);
    public function getNationalities(NationalityFilter $NationalityFilter);
}