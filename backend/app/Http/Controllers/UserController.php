<?php

namespace App\Http\Controllers;

use App\Application\Helpers\ApiHelper\ApiResponseHelper;
use App\Application\Helpers\ApiHelper\Result;
use App\Application\Helpers\ApiHelper\SuccessResult;
use App\Application\Services\User\UserService;
use App\Domain\Action\User\UpdateUserAction;
use App\Http\Requests\User\ChangeUserStatusRequest;
use App\Http\Requests\User\CreateUserRequest;
use App\Http\Requests\User\GetUserListRequest;
use App\Http\Requests\User\UpdateUsertRequest;
use App\Http\Resources\PaginationResource;
use App\Http\Resources\User\UserResource;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function __construct(private UserService $userService) {}

    public function index()
    {
        $getData = $this->userService->getUser();
        $returnData = UserResource::collection($getData);
        $pagination = PaginationResource::make($getData);
        return ApiResponseHelper::sendResponseWithPagination(
            new Result($returnData, $pagination, "Done")
        );
    }

    public function getUserList(GetUserListRequest $request)
    {
        $data = $this->userService->getUserList($request->generateFilter());
        $returnData = UserResource::collection($data);
        $pagination = PaginationResource::make($data);
        return ApiResponseHelper::sendResponseWithPagination(
            new Result($returnData, $pagination, "DONE")
        );
    }

    public function show($id)
    {
        $showCity = $this->userService->showUser($id);
        $returnData = UserResource::make($showCity);
        return ApiResponseHelper::sendResponse(
            new Result($returnData, "DONE")
        );
    }

    public function changeUserStatus(ChangeUserStatusRequest $request, $id)
    {
        $updatedData = $this->userService->changeUserStatus($id, $request->getData());
        $returnData = UserResource::make($updatedData);
        return ApiResponseHelper::sendResponse(
            new Result($returnData, "Status Updated")
        );
    }

    public function store(CreateUserRequest $request)
    {
        if ($request->has('roles') && is_array($request->input('roles')) && count($request->input('roles')) > 0) {
            $roles = $request->input('roles');
            $createdData = $this->userService->createUser($request->getData(), $roles);
        } else {
            $createdData = $this->userService->createUser($request->getData());
        }
        $returnData = UserResource::make($createdData);
        return ApiResponseHelper::sendResponse(
            new Result($returnData, "Done")
        );
    }

    public function update(UpdateUsertRequest $request, $id)
    {


        if ($request->has('roles') && is_array($request->input('roles')) && count($request->input('roles')) > 0) {


            $roles = $request->input('roles');
            $preData = UpdateUserAction::execute($request->getData());
            $updatedData = $this->userService->updateUser($id, $preData, $roles);
        } else {
            $preData = UpdateUserAction::execute($request->getData());
            $updatedData = $this->userService->updateUser($id, $preData);

            $updatedData = $this->userService->updateUser($id, $preData);
        }


        $returnData = UserResource::make($updatedData);

        return ApiResponseHelper::sendResponse(
            new Result($returnData, "Updated")
        );
    }

    public function destroy($id)
    {
        $deleteData = $this->userService->deleteUser($id);

        return ApiResponseHelper::sendSuccessResponse(new SuccessResult("deleted"));
    }
}
