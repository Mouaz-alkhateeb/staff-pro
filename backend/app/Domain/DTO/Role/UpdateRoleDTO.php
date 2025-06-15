<?php

namespace App\Domain\DTO\Role;

class UpdateRoleDTO extends \Spatie\LaravelData\Data
{
    public array $permissions;

    public function setPermissions(array $permissions): void
    {
        $this->permissions = $permissions;
    }
}
