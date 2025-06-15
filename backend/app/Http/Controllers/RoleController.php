<?php

namespace App\Http\Controllers;

use App\Application\Helpers\ApiHelper\ApiResponseHelper;
use App\Application\Helpers\ApiHelper\Result;
use App\Application\Helpers\ApiHelper\SuccessResult;
use App\Application\Services\Role\RoleServices;
use App\Http\Requests\Role\CreateRoleRequest;
use App\Http\Requests\Role\GetRoleListRequest;
use App\Http\Requests\Role\UpdateRoleRequest;
use App\Http\Resources\PaginationResource;
use App\Http\Resources\Role\RoleResource;
use Illuminate\Http\Request;

class RoleController extends Controller
{
    public function __construct(
        private RoleServices $roleServices
    ) {}

    public function index(GetRoleListRequest $request)
    {
        $getData = $this->roleServices->getRoles($request->generateFilter());
        $returnData = RoleResource::collection($getData);
        $pagination = PaginationResource::make($getData);
        return ApiResponseHelper::sendResponseWithPagination(
            new Result($returnData, $pagination, "Done")
        );
    }

    public function store(CreateRoleRequest $request)
    {
        $createdData = $this->roleServices->createRole($request->getRoleData());
        $returnData = RoleResource::make($createdData);
        return ApiResponseHelper::sendResponse(
            new Result($returnData, "Done")
        );
    }

    public function show($id)
    {
        $getData = $this->roleServices->showRole($id);
        $returnData = RoleResource::make($getData);
        return ApiResponseHelper::sendResponse(
            new Result($returnData, "Done")
        );
    }

    public function updateRolePermissions(UpdateRoleRequest $request, $id)
    {
        $updatedData = $this->roleServices->updateRole($id, $request->getPermissions());
        $returnData = RoleResource::make($updatedData);
        return ApiResponseHelper::sendResponse(
            new Result($returnData, "Updated")
        );
    }


    public function destroy($id)
    {
        $deleteData = $this->roleServices->deleteRole($id);

        return ApiResponseHelper::sendSuccessResponse(new SuccessResult("deleted"));
    }
}
