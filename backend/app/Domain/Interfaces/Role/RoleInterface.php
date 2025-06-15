<?php

namespace App\Domain\Interfaces\Role;

use App\Domain\DTO\Role\CreateRoleDTO;
use App\Domain\DTO\Role\UpdateRoleDTO;
use App\Domain\Filter\Role\RoleFilter;

interface RoleInterface
{
    public function createRole(CreateRoleDTO $data);
    public function updateRole(int $id, UpdateRoleDTO $data);
    public function deleteRole(int $id);
    public function getRoles(RoleFilter  $roleFilter);
}
