<?php

namespace App\Domain\Action\User;

use App\Domain\DTO\User\CreateUserDTO;
use Illuminate\Support\Facades\Hash;

class RegisterUserAction
{
    public static function execute(CreateUserDTO $createUserDTO)
    {
        $createUserDTO->gender = $createUserDTO->gender ?? "Male";
        $createUserDTO->password = Hash::make($createUserDTO->password);
        return $createUserDTO;
    }
}