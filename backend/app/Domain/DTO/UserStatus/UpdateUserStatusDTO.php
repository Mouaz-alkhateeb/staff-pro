<?php

namespace App\Domain\DTO\UserStatus;


class UpdateUserStatusDTO extends \Spatie\LaravelData\Data
{
    public string $name;

    /**
     * @param string $name
     */
    public function setName(string $name): void
    {
        $this->name = $name;
    }
}