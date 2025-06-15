<?php

namespace App\Infrastructure\Repository\Nationality;

use App\Domain\Entity\Nationality;
use App\Domain\Filter\Nationality\NationalityFilter;
use App\Infrastructure\Repository\BaseRepositoryImplementation;

class NationalityRepository extends BaseRepositoryImplementation
{
    public function getFilterItems($filter)
    {

        $records = Nationality::query();
        if ($filter instanceof NationalityFilter) {

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

    /**
     * Specify Model class name.
     * @return mixed
     */
    public function model()
    {
        return Nationality::class;
    }
}