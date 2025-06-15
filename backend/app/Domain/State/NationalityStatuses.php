<?php

namespace App\Domain\State;

class NationalityStatuses
{
    public const ACTIVE_NATIONALITY = 1;
    public const INACTIVE_NATIONALITY = 0;

    public static array $statuses = [self::ACTIVE_NATIONALITY, self::INACTIVE_NATIONALITY];
}
