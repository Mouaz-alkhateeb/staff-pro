<?php

namespace App\Domain\Action\Department;

use App\Domain\DTO\Department\CreateDepartmentDTO;
use App\Domain\State\DepartmentStatuses;

class CreateDepartmentAction
{
    public static function execute(CreateDepartmentDTO $createDepartmentDTO)
    {
        $createDepartmentDTO->setStatus($createDepartmentDTO->status ?? DepartmentStatuses::ACTIVE_Department);
        return $createDepartmentDTO;
    }
}