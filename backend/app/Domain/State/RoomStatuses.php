<?php

namespace App\Domain\State;

class RoomStatuses
{
    public const ACTIVE_Room = 1;
    public const INACTIVE_Room = 0;

    public static array $statuses = [self::ACTIVE_Room, self::INACTIVE_Room];
}
