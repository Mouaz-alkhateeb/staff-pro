<?php

namespace App\Infrastructure\Repository\Department;

use App\Domain\Entity\Department;
use App\Domain\Filter\Department\DepartmentFilter;

class DepartmentRepository extends \App\Infrastructure\Repository\BaseRepositoryImplementation
{

    public function model()
    {
        return Department::class;
    }

    public function getFilterItems($filter)
    {
        $records = Department::query();
        if ($filter instanceof DepartmentFilter) {
            $records->when(isset($filter->name), function ($records) use ($filter) {
                $records->where('name', 'LIKE', '%' . $filter->getName() . '%');
            });
            $records->when(isset($filter->status), function ($records) use ($filter) {
                $records->where('status', $filter->getStatus());
            });
            $records->when(isset($filter->orderBy), function ($records) use ($filter) {
                $records->orderBy($filter->getOrderBy(), $filter->getOrder());
            });
            return $records->paginate($filter->per_page);
        }
        return $records->paginate($filter->per_page);
    }
}
