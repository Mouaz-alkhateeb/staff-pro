<?php

namespace App\Domain\Action\User;

use App\Domain\DTO\User\CreateUserDTO;
use Illuminate\Support\Facades\Hash;

class CreateUserAction
{
    public static function execute(CreateUserDTO $createUserDTO)
    {
        $createUserDTO->setGender($createUserDTO->gender ?? 'Not_Selected');
        return $createUserDTO;
    }
}