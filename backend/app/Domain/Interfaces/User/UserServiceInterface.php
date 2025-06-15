<?php

namespace App\Domain\Interfaces\User;

use App\Domain\DTO\User\ChangeUserStatusDTO;
use App\Domain\DTO\User\CreateUserDTO;
use App\Domain\DTO\User\SignInDTO;
use App\Domain\DTO\User\UpdateUserDTO;
use App\Domain\Filter\User\UserFilter;

interface UserServiceInterface
{
    public function login(SignInDTO $signInDTO);
    public function register(CreateUserDTO $data);
    public function getUser();
    public function getUserList(UserFilter $statusFilter);

    // public function createUser(CreateUserDTO $data, array $roles);

    // public function updateUser(int $id, UpdateUserDTO $data);

    // public function changeUserStatus(int $id, ChangeUserStatusDTO $data);

    // public function deleteUser(int $id);

    // public function showUser(int $id);
}
