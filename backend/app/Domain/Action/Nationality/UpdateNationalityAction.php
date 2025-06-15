<?php

namespace App\Domain\Action\Nationality;

use App\Domain\DTO\Nationality\UpdateNationalityDTO;

class UpdateNationalityAction
{
    public static function execute(UpdateNationalityDTO $updateNationalityDTO)
    {

        return $updateNationalityDTO;
    }
}