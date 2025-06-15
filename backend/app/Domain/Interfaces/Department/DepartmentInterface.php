<?php

namespace App\Domain\Interfaces\Department;

use App\Domain\DTO\Department\CreateDepartmentDTO;
use App\Domain\DTO\Department\UpdateDepartmentDTO;
use App\Domain\Filter\Department\DepartmentFilter;

interface DepartmentInterface
{
    public function getDepartment();
    public function createDepartment(CreateDepartmentDTO $data);
    public function updateDepartment(int $id, UpdateDepartmentDTO $data);
    public function deleteDepartment(int $id);
    public function showDepartment(int $id);
    public function getDepartmentsList(DepartmentFilter $departmentFilter);
}