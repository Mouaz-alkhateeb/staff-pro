<?php

namespace App\Domain\State;

class DepartmentStatuses
{
    public const  ACTIVE_Department = 1;
    public const INACTIVE_Department = 0;

    public static array $statuses = [self::ACTIVE_Department, self::INACTIVE_Department];
}