<?php

namespace App\Domain\DTO\Department;


class UpdateDepartmentDTO extends \Spatie\LaravelData\Data
{
    public ?string $name;
    public ?int $status = null;

    /**
     * @param string $status
     */
    public function setStatus(string $status): void
    {
        $this->status = $status;
    }

    /**
     * @param string $name
     */
    public function setName(string $name): void
    {
        $this->name = $name;
    }
}