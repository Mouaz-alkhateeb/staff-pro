<?php

namespace App\Http\Controllers;

use App\Application\Helpers\ApiHelper\ApiResponseHelper;
use App\Application\Helpers\ApiHelper\Result;
use App\Application\Services\Role\PermissionGroupService;
use App\Http\Requests\Role\GetPemissionGroupListRequest;
use App\Http\Resources\Role\PermissionGroupResource;
use Illuminate\Http\Request;

class PermissionGroupController extends Controller
{
    public function __construct(
        private PermissionGroupService $permissionGroupService
    ) {}
    public function getPermissionGroupsList(GetPemissionGroupListRequest $request)
    {
        $data = $this->permissionGroupService->getPermissionGroupsList($request->generateFilter());
        $returnData = PermissionGroupResource::collection($data);
        return ApiResponseHelper::sendResponse(
            new Result($returnData, "DONE")
        );
    }
}
