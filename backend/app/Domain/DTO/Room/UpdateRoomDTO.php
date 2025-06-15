<?php

namespace App\Domain\DTO\Room;

class UpdateRoomDTO extends \Spatie\LaravelData\Data
{
    public ?int $number;
    public ?int $floor;
    public ?int $status = null;
    public ?int $department_id;

    /**
     * @param string $department_id
     */
    public function setDepartmentId(string $department_id): void
    {
        $this->department_id = $department_id;
    }

    /**
     * @param string $number
     */
    public function setNumber(string $number): void
    {
        $this->number = $number;
    }

    /**
     * @param string $floor
     */
    public function setFloor(string $floor): void
    {
        $this->floor = $floor;
    }

    /**
     * @param string $status
     */
    public function setStatus(string $status): void
    {
        $this->status = $status;
    }
}