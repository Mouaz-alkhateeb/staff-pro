<?php

namespace App\Domain\Filter\Role;

use App\Domain\Filter\OthersBaseFilter;

class PermissionGroupFilter extends OthersBaseFilter
{
    public ?string $name;
    public ?string $permission_name;
    public ?int $id;

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
    public function getPermissionName(): ?string
    {
        return $this->permission_name;
    }

    /**
     * @param string|null $permission_name
     */
    public function setPermissionName(?string $permission_name): void
    {
        $this->permission_name = $permission_name;
    }

    /**
     * @return int|null
     */
    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * @param int|null $id
     */
    public function setId(?int $id): void
    {
        $this->id = $id;
    }
}
