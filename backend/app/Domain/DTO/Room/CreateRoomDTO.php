<?php

namespace App\Domain\DTO\Room;

use Spatie\LaravelData\Data;

class CreateRoomDTO extends Data
{

    public int $number;
    public int $floor;
    public ?int $status = null;
    public ?int $department_id;

    /**
     * @param int|null $department_id
     */
    public function setDepartmentId(?string $department_id): void
    {
        $this->department_id = $department_id;
    }

    /**
     * @param int $number
     */
    public function setNumber(string $number): void
    {
        $this->number = $number;
    }

    /**
     * @param int $floor
     */
    public function setFloor(string $floor): void
    {
        $this->floor = $floor;
    }

    /**
     * @param int $status
     */
    public function setStatus(string $status): void
    {
        $this->status = $status;
    }
}