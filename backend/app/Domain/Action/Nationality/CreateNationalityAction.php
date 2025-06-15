<?php

namespace App\Domain\Action\Nationality;

use App\Domain\DTO\Nationality\CreateNationalityDTO;
use App\Domain\State\NationalityStatuses;

class CreateNationalityAction
{
    public static function execute(CreateNationalityDTO $createNationalityDTO)
    {

        $createNationalityDTO->setStatus($createNationalityDTO->status ?? NationalityStatuses::ACTIVE_NATIONALITY);
        return $createNationalityDTO;
    }
}
