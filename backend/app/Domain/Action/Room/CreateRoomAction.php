<?php

namespace App\Domain\Action\Room;

use App\Domain\DTO\Room\CreateRoomDTO;
use App\Domain\State\RoomStatuses;

class CreateRoomAction
{
    public static function execute(CreateRoomDTO $createRoomDTO)
    {

        $createRoomDTO->setStatus($createRoomDTO->status ?? RoomStatuses::ACTIVE_Room);
        return $createRoomDTO;
    }
}
