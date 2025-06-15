<?php

namespace App\Application\Services\Department;

use App\Domain\DTO\Department\CreateDepartmentDTO;
use App\Domain\DTO\Department\UpdateDepartmentDTO;
use App\Domain\Filter\Department\DepartmentFilter;
use App\Domain\Interfaces\Department\DepartmentInterface;
use App\Domain\State\DepartmentStatuses;
use App\Infrastructure\Repository\Department\DepartmentRepository;
use Illuminate\Support\Facades\Lang;

class DepartmentService implements DepartmentInterface
{
    /**
     */
    public function __construct(
        private DepartmentRepository $departmentRepository
    ) {}

    public function getDepartment()
    {
        return $this->departmentRepository->paginate();
    }

    public function createDepartment(CreateDepartmentDTO $data)
    {
        return $this->departmentRepository->create($data->toArray());
    }

    public function updateDepartment(int $id, UpdateDepartmentDTO $data)
    {
        $originalDepartment = $this->departmentRepository->getById($id);
        if ($originalDepartment->status != $data->status && $data->status == DepartmentStatuses::INACTIVE_Department && $originalDepartment->count > 0) {
            throw new \Exception(Lang::get('messages.cannotDeactivateError'), 400);
        }
        return $this->departmentRepository->updateById($id, $data->toArray());
    }
    public function showDepartment(int $id)
    {

        return $this->departmentRepository->getById($id);
    }

    public function deleteDepartment(int $id)
    {

        return $this->departmentRepository->deleteById($id);
    }

    public function getDepartmentsList(DepartmentFilter $departmentFilter = null)
    {

        if ($departmentFilter != null)
            return $this->departmentRepository->getFilterItems($departmentFilter);
        else
            return $this->departmentRepository->paginate();
    }
    public function getDepartmentsByIds(array $ids)
    {
        return $this->departmentRepository->whereIn('id', $ids)->get();
    }
}