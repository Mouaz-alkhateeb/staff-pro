<?php

namespace App\Infrastructure\Repository\Role;

use App\Domain\Entity\Role;
use App\Domain\Filter\Role\RoleFilter;

class RoleRepository extends \App\Infrastructure\Repository\BaseRepositoryImplementation
{

    /**
     * @inheritDoc
     */
    public function model()
    {
        return Role::class;
    }

    public function getFilterItems($filter)
    {
        $records = Role::query()->where('status', '!=', 0);
        if ($filter instanceof RoleFilter) {
            return $records->with(['permissions', 'createdByUser'])->paginate($filter->per_page);
        }
        return $records->with(['permissions', 'createdByUser'])->paginate($filter->per_page);
    }
}
