<?php

namespace App\Domain\Interfaces\UserStatus;

use App\Domain\DTO\UserStatus\CreateUserStatusDTO;
use App\Domain\DTO\UserStatus\UpdateUserStatusDTO;
use App\Domain\Filter\UserStatus\UserStatusFilter;

interface UserStatusServiceInterface
{
    public function getStatus();
    public function createStatus(CreateUserStatusDTO $data);
    public function updateStatus(int $id, UpdateUserStatusDTO $data);
    public function deleteStatus(int $id);
    public function showStatus(int $id);
    public function getStatusList(UserStatusFilter $statusFilter);
}