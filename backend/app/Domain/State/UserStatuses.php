<?php

namespace App\Domain\State;

class UserStatuses
{
    public const ACTIVE_USER = 1;
    public const INACTIVE_USER = 2;


    public static array $statuses = [self::ACTIVE_USER, self::INACTIVE_USER];
}