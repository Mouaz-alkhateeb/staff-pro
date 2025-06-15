<?php

namespace App\Infrastructure\Repository\City;

use App\Domain\Entity\City;
use App\Domain\Filter\City\CityFilter;
use App\Infrastructure\Repository\BaseRepositoryImplementation;

class CityRepository extends BaseRepositoryImplementation
{


    public function getFilterItems($filter)
    {
        $records = City::query();
        if ($filter instanceof CityFilter) {

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
        return City::class;
    }
}