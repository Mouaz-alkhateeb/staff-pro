<?php

namespace App\Http\Controllers;

use App\Application\Services\User\UserService;
use App\Domain\Action\User\RegisterUserAction;
use App\Http\Requests\User\RegisterUserRequest;
use App\Http\Requests\User\SignInRequest;
use App\Application\Helpers\ApiHelper\ApiCode;
use App\Application\Helpers\ApiHelper\ApiResponseHelper;
use App\Application\Helpers\ApiHelper\ErrorResult;
use App\Application\Helpers\ApiHelper\Result;
use App\Domain\Action\User\ChangePasswordAction;
use App\Domain\Action\User\ResetPasswordAction;
use App\Http\Requests\User\ChangePasswordRequest;
use App\Http\Requests\User\ResetPasswordRequest;
use App\Http\Resources\User\UserResource;
use Illuminate\Support\Facades\Lang;
use Illuminate\Http\Request;

class AuthController extends Controller
{
    public function __construct(private UserService $service) {}

    public function login(SignInRequest $request)
    {
        $user = $this->service->login($request->getData());
        if ($user == null)
            return ApiResponseHelper::sendErrorResponse(new ErrorResult(Lang::get('auth.failed'), false, ApiCode::UNAUTHORIZED));
        else {
            foreach ($user->roles as $role) {
                if ($role['name'] == 'No_Access') {
                    throw new \Exception(Lang::get('messages.userHaveNoAccess'), ApiCode::UNAUTHORIZED);
                }
            }
            return ApiResponseHelper::sendResponse(new Result(UserResource::make($user), null, 'done', true));
        }
    }

    public function register(RegisterUserRequest $request)
    {
        $processedData = RegisterUserAction::execute($request->data());
        $user = $this->service->register($processedData);
        return ApiResponseHelper::sendResponse(new Result($user, null, 'done', true));
    }


    public function changePassword(ChangePasswordRequest $request)
    {
        $processedData = ChangePasswordAction::execute($request->getData());
        $user = $this->service->changePassword($processedData);
        return ApiResponseHelper::sendResponse(new Result($user, null, 'done', true));
    }

    public function resetPassword(ResetPasswordRequest $request)
    {

        $processedData = ResetPasswordAction::execute($request->getData());
        $user = $this->service->resetPassword($processedData);

        return ApiResponseHelper::sendResponse(new Result($user, null, 'done', true));
    }


    public function logout(Request $request)
    {

        $this->service->logoutUser($request);

        return ApiResponseHelper::sendResponse(new Result(null, null, 'done', true));
    }
}
