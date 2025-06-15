<?php

namespace App\Domain\Rules\Room;

use App\Domain\State\RoomStatuses;
use Illuminate\Validation\Rule;

class UpdateRoomRules
{
    public static function rules(): array
    {
        return [
            'number' => 'gte:0|numeric|required',
            'floor' => 'numeric|required',
            'status' => ['sometimes', Rule::in(RoomStatuses::$statuses)],
            'department_id' => 'required|exists:departments,id'

        ];
    }
}