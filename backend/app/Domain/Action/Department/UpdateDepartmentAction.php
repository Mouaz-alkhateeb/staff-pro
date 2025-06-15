<?php

namespace App\Domain\Action\Department;

use App\Domain\DTO\Department\UpdateDepartmentDTO;

class UpdateDepartmentAction
{
    public static function execute(UpdateDepartmentDTO $updateDepartmentDTO)
    {
        return $updateDepartmentDTO;
    }
}