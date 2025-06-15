<?php

namespace App\Infrastructure\Repository\UserStatus;

use App\Domain\Entity\UserStatus;
use App\Domain\Filter\UserStatus\UserStatusFilter;
use App\Infrastructure\Repository\BaseRepositoryImplementation;

class UserStatusRepository extends BaseRepositoryImplementation
{

    /**
     * @inheritDoc
     */
    public function model()
    {
        return UserStatus::class;
    }

    public function getFilterItems($filter)
    {
        $records = UserStatus::query();
        if ($filter instanceof UserStatusFilter) {
            $records->when(isset($filter->name), function ($records) use ($filter) {
                $records->where('name', 'LIKE', '%' . $filter->getName() . '%');
            });
            $records->when(isset($filter->orderBy), function ($records) use ($filter) {
                $records->orderBy($filter->getOrderBy(), $filter->getOrder());
            });

            return $records->paginate($filter->per_page);
        }
        return $records->paginate($filter->per_page);
    }
}