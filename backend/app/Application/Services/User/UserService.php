<?php

namespace App\Application\Services\User;

use App\Domain\Action\User\CreateUserAction;
use App\Domain\DTO\User\ChangePasswordDTO;
use App\Domain\DTO\User\ChangeUserStatusDTO;
use App\Domain\DTO\User\CreateUserDTO;
use App\Domain\DTO\User\ResetPasswordDTO;
use App\Domain\DTO\User\SignInDTO;
use App\Domain\DTO\User\UpdateUserDTO;
use App\Domain\Entity\Role;
use App\Domain\Filter\User\UserFilter;
use App\Domain\Interfaces\User\UserServiceInterface;
use App\Infrastructure\Repository\User\UserRepository;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class UserService implements UserServiceInterface
{

    public function __construct(private UserRepository $userRepository) {}

    public function login(SignInDTO $signInDTO)
    {
        if (Auth::guard('web')->attempt($signInDTO->toArray())) {
            $user = auth()->user();
            $token = auth()->user()->createToken('Token')->plainTextToken;
            $user->token = $token;
            $user->load(['roles.permissions']);
            return $user;
        } else return null;
    }

    public function register(CreateUserDTO $data)
    {
        $user = $this->userRepository->create($data->toArray());

        $user->assignRole('User');

        return $user;
    }

    public function getUser()
    {
        $this->userRepository->setWith(['room', 'city', 'user_status']);
        return $this->userRepository->paginate();
    }

    public function getUserList(UserFilter $userFilter = null)
    {
        if ($userFilter != null)

            return $this->userRepository->getFilterItems($userFilter);
        else
            return $this->userRepository->paginate();
    }

    public function showUser(int $id)
    {
        return $this->userRepository->getById($id)->load(['room', 'city', 'user_status', 'media']);
    }

    public function changeUserStatus(int $id, ChangeUserStatusDTO $data)
    {
        $user = $this->userRepository->updateById($id, $data->toArray());
        $user->load('user_status');
        return $user;
    }

    public function createUser(CreateUserDTO $data, $roles = [])
    {


        $preData = CreateUserAction::execute($data);
        $user = $this->userRepository->create($preData->toArray());

        if (!empty($roles) && is_array($roles)) {
            foreach ($roles as $roleId) {
                if ($roleId == 1) {
                    $user->assignRole('Admin');
                } elseif ($roleId == 2) {
                    $user->assignRole('User');
                }
            }
        }


        return $user->load(['room', 'city', 'user_status', 'roles']);
    }

    public function updateUser(int $id, UpdateUserDTO $data, $roles = [])
    {
        $user = $this->userRepository->updateById($id, $data->toArray());

        if (!empty($roles) && is_array($roles)) {
            $roleNames = [];

            foreach ($roles as $roleId) {
                if ($roleId == 1) {
                    $roleNames[] = 'Admin';
                } elseif ($roleId == 2) {
                    $roleNames[] = 'User';
                }
            }

            $user->syncRoles($roleNames);
        }

        return $user->load(['room', 'city', 'user_status', 'roles']);
    }

    public function changePassword(ChangePasswordDTO $signInDTO)
    {
        if (Auth::check()) {
            if (Auth::id() == $signInDTO->user_id)
                return $this->userRepository->updateById($signInDTO->user_id, [
                    'password' => $signInDTO->password
                ]);
        } else return null;
    }

    public function logoutUser(Request $request)
    {
        return $request->user()->currentAccessToken()->delete();
    }

    public function resetPassword(ResetPasswordDTO $data)
    {
        return $this->userRepository->updateById($data->user_id, [
            'password' => $data->password
        ]);
    }
    public function deleteUser(int $id)
    {
        return $this->userRepository->deleteById($id);
    }
}
