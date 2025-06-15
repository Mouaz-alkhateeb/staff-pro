<?php

namespace App\Domain\Filter\Room;

use App\Domain\Filter\OthersBaseFilter;

class RoomFilter extends OthersBaseFilter
{
    public ?int $number;
    public ?int $floor;
    public ?int $department_id;
    public ?int $status;

    /**
     * @return int|null
     */
    public function getStatus(): ?int
    {
        return $this->status;
    }

    /**
     * @param int|null $status
     */
    public function setStatus(?int $status): void
    {
        $this->status = $status;
    }

    /**
     * @return int|null
     */
    public function getNumber(): ?int
    {
        return $this->number;
    }

    /**
     * @param int|null $number
     */
    public function setNumber(?int $number): void
    {
        $this->number = $number;
    }

    /**
     * @return int|null
     */
    public function getFloor(): ?int
    {
        return $this->floor;
    }

    /**
     * @param int|null $floor
     */
    public function setFloor(?int $floor): void
    {
        $this->floor = $floor;
    }

    /**
     * @return int|null
     */
    public function getDepartmentId(): ?int
    {
        return $this->department_id;
    }

    /**
     * @param int|null $department_id
     */
    public function setDepartmentId(?int $department_id): void
    {
        $this->department_id = $department_id;
    }
}