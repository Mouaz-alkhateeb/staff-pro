<?php

namespace App\Domain\DTO\User;

use Spatie\LaravelData\Data;

class ChangeUserStatusDTO extends Data
{
    public int $user_status_id;

    /**
     * @param int $user_status_id
     */
    public function setUserStatusId(int $user_status_id): void
    {
        $this->user_status_id = $user_status_id;
    }
}