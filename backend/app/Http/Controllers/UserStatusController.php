<?php

namespace App\Http\Controllers;

use App\Application\Helpers\ApiHelper\ApiResponseHelper;
use App\Application\Helpers\ApiHelper\Result;
use App\Application\Helpers\ApiHelper\SuccessResult;
use App\Application\Services\UserStatus\UserStatusService;
use App\Http\Requests\UserStatus\CreateUserStatusRequest;
use App\Http\Requests\UserStatus\GetUserStatusListRequest;
use App\Http\Requests\UserStatus\UpdateUserStatusRequest;
use App\Http\Resources\PaginationResource;
use App\Http\Resources\User\UserStatusResource;
use Illuminate\Http\Request;

class UserStatusController extends Controller
{
    public function __construct(
        private UserStatusService $statusService
    ) {}
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $getData = $this->statusService->getStatus();
        $returnData = UserStatusResource::collection($getData);
        $pagination = PaginationResource::make($getData);
        return ApiResponseHelper::sendResponseWithPagination(
            new Result($returnData, $pagination, "Done")
        );
    }
    public function getStatusList(GetUserStatusListRequest $request)
    {
        $data = $this->statusService->getStatusList($request->generateFilter());
        $returnData = UserStatusResource::collection($data);
        $pagination = PaginationResource::make($data);
        return ApiResponseHelper::sendResponseWithPagination(
            new Result($returnData, $pagination, "DONE")
        );
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CreateUserStatusRequest $request)
    {
        $createdData = $this->statusService->createStatus($request->getData());

        $returnData = UserStatusResource::make($createdData);

        return ApiResponseHelper::sendResponse(
            new Result($returnData, "Done")
        );
    }
    public function show($id)
    {
        $showCity = $this->statusService->showStatus($id);
        $returnData = UserStatusResource::make($showCity);
        return ApiResponseHelper::sendResponse(
            new Result($returnData,  "DONE")
        );
    }
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateUserStatusRequest $request, $id)
    {
        //dd('55');
        $updatedData = $this->statusService->updateStatus($id, $request->getData());

        $returnData = UserStatusResource::make($updatedData);

        return ApiResponseHelper::sendResponse(
            new Result($returnData, "Updated")
        );
    }
    public function destroy($id)
    {
        $deleteData = $this->statusService->deleteStatus($id);

        return ApiResponseHelper::sendSuccessResponse(new SuccessResult("deleted"));
    }
}
