<?php

namespace App\Domain\DTO\City;

class UpdateCityDTO extends \Spatie\LaravelData\Data
{
    public ?string $name;
    public ?int $status = null;

    public function setName(string $name): void
    {
        $this->name = $name;
    }

    public function setStatus(int $status): void
    {
        $this->status = $status;
    }
}
