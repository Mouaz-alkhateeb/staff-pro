<?php

namespace App\Domain\Filter\Nationality;

use App\Domain\Filter\OthersBaseFilter;

class NationalityFilter extends OthersBaseFilter
{

    public ?string $name;

    public ?int $status;


    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @param string $name
     */
    public function setName(string $name): void
    {
        $this->name = $name;
    }
    public function getStatus(): int
    {
        return $this->status;
    }

    /**
     * @param string $name
     */
    public function setStatus(int $status): void
    {
        $this->status = $status;
    }
}