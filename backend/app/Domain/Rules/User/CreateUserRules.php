<?php

namespace App\Domain\Rules\User;



class CreateUserRules
{
    public static function rules(): array
    {

        return [
            'first_name' => 'string|required',
            'last_name' => 'string|sometimes',
            'gender' => 'sometimes|in:Male,Female,Not_Selected',
            'birth_date' => 'date|sometimes',
            'phone_number' => 'required',
            'address' => 'string|sometimes|max:1000',
            'room_id' => 'sometimes|exists:rooms,id',
            'city_id' => 'sometimes|exists:cities,id',
            'user_status_id' => 'sometimes|exists:user_statuses,id',
            'roles' => 'nullable|array',
            'roles.*' => 'exists:roles,id',
        ];
    }
}
