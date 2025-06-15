<?php

namespace App\Infrastructure\Repository\Role;

use App\Domain\Entity\PermissionGroup;
use App\Domain\Filter\Role\PermissionGroupFilter;
use App\Infrastructure\Repository\BaseRepositoryImplementation;

class PermissionGroupRepository extends BaseRepositoryImplementation
{

    /**
     * @inheritDoc
     */
    public function model()
    {
        return PermissionGroup::class;
    }

    public function getFilterItems($filter)
    {
        $records = PermissionGroup::query();
        if ($filter instanceof PermissionGroupFilter) {
            $records->when(isset($filter->name), function ($records) use ($filter) {
                $records->where('display_name', 'LIKE', '%' . $filter->getName() . '%');
            });
            $records->when(isset($filter->id), function ($records) use ($filter) {
                $records->where('id', $filter->getId());
            });
            $records->when(isset($filter->permission_name), function ($records) use ($filter) {
                $records->whereHas('permissions', function ($q) use ($filter) {
                    return $q->where('display_name', 'LIKE', '%' . $filter->getPermissionName() . '%');
                });
            });

            return $records->with(['permissions'])->get();
        }
        return $records->get();
    }
}
