<?php

namespace App\Infrastructure\Repository\User;

use App\Domain\Entity\User;
use App\Domain\Filter\User\UserFilter;

class UserRepository extends \App\Infrastructure\Repository\BaseRepositoryImplementation
{
    public function model()
    {
        return User::class;
    }
    public function getFilterItems($filter)
    {
        $records = User::query();
        if ($filter instanceof UserFilter) {

            $records->when(isset($filter->gender), function ($records) use ($filter) {
                $records->where('gender', $filter->getGender());
            });
            $records->when(isset($filter->phone_number), function ($records) use ($filter) {
                $records->where('phone_number', $filter->getPhoneNumber());
            });
            $records->when(isset($filter->room_id), function ($records) use ($filter) {
                $records->where('room_id', $filter->getRoomId());
            });
            $records->when(isset($filter->city_id), function ($records) use ($filter) {
                $records->where('city_id', $filter->getCityId());
            });
            $records->when(isset($filter->status_id), function ($records) use ($filter) {
                $records->where('user_status_id', $filter->getStatusId());
            });
            $records->when(isset($filter->orderBy), function ($records) use ($filter) {
                $records->orderBy($filter->getOrderBy(), $filter->getOrder());
            });
            $records->when((isset($filter->first_name) || isset($filter->last_name)), function ($records) use ($filter) {
                $records->where('first_name', 'LIKE', '%' . $filter->getFirstName() . '%')
                    ->orWhere('last_name', 'LIKE', '%' . $filter->getLastName() . '%');
            });
            return $records->with(['room', 'city', 'user_status'])->paginate($filter->per_page);
        }
        return $records->with(['room', 'city', 'user_status'])->paginate($filter->per_page);
    }
}