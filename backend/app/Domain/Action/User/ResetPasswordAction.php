<?php

namespace App\Domain\Action\User;

use App\Domain\DTO\User\ResetPasswordDTO;
use App\Domain\State\DefaultPasswords;
use Illuminate\Support\Facades\Hash;

class ResetPasswordAction
{
    public static function execute(ResetPasswordDTO $resetPasswordDTO)
    {
        $resetPasswordDTO->setPassword(Hash::make(DefaultPasswords::USER_PASSWORD));
        return $resetPasswordDTO;
    }
}