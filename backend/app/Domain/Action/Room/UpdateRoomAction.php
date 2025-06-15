<?php

namespace App\Domain\Action\Room;

use App\Domain\DTO\Room\UpdateRoomDTO;

class UpdateRoomAction
{
    public static function execute(UpdateRoomDTO $updateRoomDTO)
    {
        return $updateRoomDTO;
    }
}