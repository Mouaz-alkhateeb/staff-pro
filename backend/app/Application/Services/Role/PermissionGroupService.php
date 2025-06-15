<?php

namespace App\Application\Services\Role;

use App\Domain\Filter\Role\PermissionGroupFilter;
use App\Domain\Interfaces\Role\PermissionGroupInterface;
use App\Infrastructure\Repository\Role\PermissionGroupRepository;

class PermissionGroupService implements PermissionGroupInterface
{
    /**
     */
    public function __construct(
        private PermissionGroupRepository $permissionGroupRepository
    ) {}

    public function getPermissionGroupsList(PermissionGroupFilter $permissionGroupFilter = null)
    {
        if ($permissionGroupFilter != null)
            return $this->permissionGroupRepository->getFilterItems($permissionGroupFilter);
        else
            return $this->permissionGroupRepository->get();
    }
}
