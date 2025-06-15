<?php

namespace App\Application\Services\UserStatus;

use App\Domain\DTO\UserStatus\CreateUserStatusDTO;
use App\Domain\DTO\UserStatus\UpdateUserStatusDTO;
use App\Domain\Filter\UserStatus\UserStatusFilter;
use App\Domain\Interfaces\UserStatus\UserStatusServiceInterface;
use App\Infrastructure\Repository\UserStatus\UserStatusRepository;

class UserStatusService implements UserStatusServiceInterface
{

    public function __construct(private UserStatusRepository $statusRepository) {}

    public function getStatus()
    {
        return $this->statusRepository->paginate();
    }

    public function getStatusList(UserStatusFilter $statusFilter = null)
    {
        if ($statusFilter != null)
            return $this->statusRepository->getFilterItems($statusFilter);
        else
            return $this->statusRepository->paginate();
    }

    public function createStatus(CreateUserStatusDTO $data)
    {
        return $this->statusRepository->create($data->toArray());
    }

    public function updateStatus(int $id, UpdateUserStatusDTO $data)
    {
        return $this->statusRepository->updateById($id, $data->toArray());
    }
    public function showStatus(int $id)
    {

        return $this->statusRepository->getById($id);
    }

    public function deleteStatus(int $id)
    {
        return $this->statusRepository->deleteById($id);
    }
}