<?php

namespace App\Domain\Interfaces\Role;

use App\Domain\Filter\Role\PermissionGroupFilter;

interface PermissionGroupInterface
{
    public function getPermissionGroupsList(PermissionGroupFilter $permissionGroupFilter);
}
