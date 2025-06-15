<?php

namespace App\Application\Services\Role;

use App\Domain\DTO\Role\CreateRoleDTO;
use App\Domain\DTO\Role\UpdateRoleDTO;
use App\Domain\Filter\Role\RoleFilter;
use App\Domain\Interfaces\Role\RoleInterface;
use App\Infrastructure\Repository\Role\RoleRepository;
use Illuminate\Support\Facades\Lang;

class RoleServices implements RoleInterface
{
    public function __construct(
        private RoleRepository $roleRepository
    ) {}


    public function createRole(CreateRoleDTO $data)
    {
        return $this->roleRepository->create($data->toArray());
    }

    public function updateRole(int $id, UpdateRoleDTO $data)
    {
        $role = $this->roleRepository->getById($id);
        if ($role->name == 'No_Access') {
            throw new \Exception(Lang::get('messages.cannotUpdateNoAccessRole'), 400);
        } else {
            $role->syncPermissions($data->permissions);
            return $role;
        }
    }


    public function deleteRole(int $id)
    {
        return $this->roleRepository->deleteById($id);
    }


    public function getRoles(RoleFilter  $roleFilter = null)
    {
        if ($roleFilter != null)
            $roles = $this->roleRepository->getFilterItems($roleFilter);
        else
            $roles = $this->roleRepository->with(['createdByUser'])->paginate();

        foreach ($roles as $role) {
            $role['users_count'] = $role->users ? count($role->users) : 0;
        }
        return $roles;
    }
    public function showRole(int $id)
    {
        return $this->roleRepository->with(['permissions'])->getById($id);
    }
}
