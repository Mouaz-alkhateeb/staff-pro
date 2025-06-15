<?php

namespace App\Domain\Action\User;

use App\Domain\DTO\User\ChangePasswordDTO;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class ChangePasswordAction
{
    public static function execute(ChangePasswordDTO $changePasswordDTO)
    {
        $changePasswordDTO->setPassword(Hash::make($changePasswordDTO->password));
        $changePasswordDTO->setUserId($changePasswordDTO->user_id ?? Auth::id());
        return $changePasswordDTO;
    }
}