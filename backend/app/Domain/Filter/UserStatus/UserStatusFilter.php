<?php

namespace App\Domain\Filter\UserStatus;

use App\Domain\Filter\OthersBaseFilter;

class UserStatusFilter extends OthersBaseFilter
{
    public ?string $name;

    /**
     * @return string|null
     */
    public function getName(): ?string
    {
        return $this->name;
    }

    /**
     * @param string|null $name
     */
    public function setName(?string $name): void
    {
        $this->name = $name;
    }
}