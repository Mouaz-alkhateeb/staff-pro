<?php

namespace App\Domain\Filter\Role;

use App\Domain\Filter\OthersBaseFilter;

class RoleFilter extends OthersBaseFilter
{
    public ?int $team_id;
    public ?string $name;
    public ?string $guard_name;
    public ?string $description;

    /**
     * @return int|null
     */
    public function getTeamId(): ?int
    {
        return $this->team_id;
    }

    /**
     * @param int|null $team_id
     */
    public function setTeamId(?int $team_id): void
    {
        $this->team_id = $team_id;
    }

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

    /**
     * @return string|null
     */
    public function getGuardName(): ?string
    {
        return $this->guard_name;
    }

    /**
     * @param string|null $guard_name
     */
    public function setGuardName(?string $guard_name): void
    {
        $this->guard_name = $guard_name;
    }

    /**
     * @return string|null
     */
    public function getDescription(): ?string
    {
        return $this->description;
    }

    /**
     * @param string|null $description
     */
    public function setDescription(?string $description): void
    {
        $this->description = $description;
    }
}
