<?php

namespace App\Http\Controllers;

use App\Application\Helpers\ApiHelper\ApiResponseHelper;
use App\Application\Helpers\ApiHelper\Result;
use App\Application\Helpers\ApiHelper\SuccessResult;
use App\Application\Services\Department\DepartmentService;
use App\Domain\Action\Department\CreateDepartmentAction;
use App\Domain\Action\Department\UpdateDepartmentAction;
use App\Http\Requests\Department\CreateDepartmentRequest;
use App\Http\Requests\Department\GetDepartmentListRequest;
use App\Http\Requests\Department\UpdateDepartmentRequest;
use App\Http\Resources\Department\DepartmentResource;
use App\Http\Resources\PaginationResource;
use Illuminate\Http\Request;

class DepartmentController extends Controller
{
    public function __construct(
        private DepartmentService $departmentService
    ) {}
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $getData = $this->departmentService->getDepartment();
        $returnData = DepartmentResource::collection($getData);
        $pagination = PaginationResource::make($getData);
        return ApiResponseHelper::sendResponseWithPagination(
            new Result($returnData, $pagination, "Done")
        );
    }

    public function getDepartmentList(GetDepartmentListRequest $request)
    {
        $data = $this->departmentService->getDepartmentsList($request->generateFilter());
        $returnData = DepartmentResource::collection($data);
        $pagination = PaginationResource::make($data);
        return ApiResponseHelper::sendResponseWithPagination(
            new Result($returnData, $pagination, "DONE")
        );
    }

    public function store(CreateDepartmentRequest $request)
    {
        $preData = CreateDepartmentAction::execute($request->getData());

        $createdData = $this->departmentService->createDepartment($preData);

        $returnData = DepartmentResource::make($createdData);

        return ApiResponseHelper::sendResponse(
            new Result($returnData, "Done")
        );
    }

    public function show($id)
    {
        $showCity = $this->departmentService->showDepartment($id);
        $returnData = DepartmentResource::make($showCity);
        return ApiResponseHelper::sendResponse(
            new Result($returnData,  "DONE")
        );
    }


    public function update(UpdateDepartmentRequest $request, $id)
    {
        $preData = UpdateDepartmentAction::execute($request->getData());

        $updatedData = $this->departmentService->updateDepartment($id, $preData);

        $returnData = DepartmentResource::make($updatedData);

        return ApiResponseHelper::sendResponse(
            new Result($returnData, "Updated")
        );
    }

    public function destroy($id)
    {
        $deleteData = $this->departmentService->deleteDepartment($id);

        return ApiResponseHelper::sendSuccessResponse(new SuccessResult("deleted"));
    }
}
