<?php

namespace App\Domain\DTO\Nationality;


class UpdateNationalityDTO extends \Spatie\LaravelData\Data
{

    public string $name;
    public ?int $status = null;

    /**
     * @param string $name
     */
    public function setName(string $name): void
    {
        $this->name = $name;
    }

    /**
     * @param int $status
     */
    public function setStatus(int $status): void
    {
        $this->status = $status;
    }
}