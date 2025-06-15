<?php

namespace App\Domain\State;

class CityStatuses
{
    public const ACTIVE_CITY = 1;
    public const INACTIVE_CITY = 0;

    public static array $statuses = [self::ACTIVE_CITY, self::INACTIVE_CITY];
}