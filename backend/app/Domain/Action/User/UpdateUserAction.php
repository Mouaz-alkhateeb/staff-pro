<?php

namespace App\Domain\Action\User;

use App\Domain\DTO\User\UpdateUserDTO;

class UpdateUserAction
{
    public static function execute(UpdateUserDTO $updateUserDTO)
    {
        return $updateUserDTO;
    }
}
