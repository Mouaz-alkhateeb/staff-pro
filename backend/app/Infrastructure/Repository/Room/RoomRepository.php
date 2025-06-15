<?php

namespace App\Infrastructure\Repository\Room;

use App\Domain\Entity\Room;
use App\Domain\Filter\Room\RoomFilter;
use App\Infrastructure\Repository\BaseRepositoryImplementation;

class RoomRepository extends BaseRepositoryImplementation
{

    /**
     * @inheritDoc
     */
    public function model()
    {
        return Room::class;
    }

    public function getFilterItems($filter)
    {
        $records = Room::query();
        if ($filter instanceof RoomFilter) {
            $records->when(isset($filter->number), function ($records) use ($filter) {
                $records->where('number', 'LIKE', '%' . $filter->getNumber() . '%');
            });
            $records->when(isset($filter->floor), function ($records) use ($filter) {
                $records->where('floor', 'LIKE', '%' . $filter->getFloor() . '%');
            });
            $records->when(isset($filter->status), function ($records) use ($filter) {
                $records->where('status', $filter->getStatus());
            });
            $records->when(isset($filter->department_id), function ($records) use ($filter) {
                $records->where('department_id', $filter->getDepartmentId());
            });
            $records->when(isset($filter->orderBy), function ($records) use ($filter) {
                $records->orderBy($filter->getOrderBy(), $filter->getOrder());
            });

            return $records->with('department')->paginate($filter->per_page);
        }
        return $records->with('department')->paginate($filter->per_page);
    }
}