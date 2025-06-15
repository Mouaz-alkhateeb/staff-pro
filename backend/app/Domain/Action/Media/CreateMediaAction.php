<?php

namespace App\Domain\Action\Media;

use App\Domain\DTO\Media\CreateMediaDTO;
use Illuminate\Support\Facades\Auth;

class CreateMediaAction
{
    public static function execute(CreateMediaDTO $createMediaDTO)
    {
        $createMediaDTO->setUploadedBy(Auth::id());
        return $createMediaDTO;
    }
}