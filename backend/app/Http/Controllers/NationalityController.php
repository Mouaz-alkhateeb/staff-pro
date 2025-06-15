<?php

namespace App\Http\Controllers;

use App\Application\Helpers\ApiHelper\ApiResponseHelper;
use App\Application\Helpers\ApiHelper\Result;
use App\Application\Helpers\ApiHelper\SuccessResult;
use App\Application\Services\Nationality\NationalityService;
use App\Domain\Action\Nationality\CreateNationalityAction;
use App\Domain\Action\Nationality\UpdateNationalityAction;
use App\Http\Requests\Nationality\CreateNationalityRequest;
use App\Http\Requests\Nationality\GetNationalitiesRequest;
use App\Http\Requests\Nationality\UpdateNationalityRequest;
use App\Http\Resources\Nationality\NationalityResource;
use App\Http\Resources\PaginationResource;
use Illuminate\Http\Request;

class NationalityController extends Controller
{

    public function __construct(private NationalityService $nationalityService) {}

    public function index()
    {
        $data = $this->nationalityService->getNationalities();
        $returnData = NationalityResource::collection($data);
        $pagination = PaginationResource::make($data);
        return ApiResponseHelper::sendResponseWithPagination(
            new Result($returnData, $pagination, "DONE")
        );
    }
    public function getNationalitiesList(GetNationalitiesRequest $request)
    {
        $data = $this->nationalityService->getNationalities($request->generateFilter());

        $returnData = NationalityResource::collection($data);
        $pagination = PaginationResource::make($data);
        return ApiResponseHelper::sendResponseWithPagination(
            new Result($returnData, $pagination, "DONE")
        );
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CreateNationalityRequest $request)
    {
        $preData = CreateNationalityAction::execute($request->getData());

        $createdData = $this->nationalityService->createNationality($preData);

        $returnData = NationalityResource::make($createdData);

        return ApiResponseHelper::sendResponse(
            new Result($returnData, "Done")
        );
    }

    public function show($id)
    {
        $showCity = $this->nationalityService->showNationality($id);
        $returnData = NationalityResource::make($showCity);
        return ApiResponseHelper::sendResponse(
            new Result($returnData,  "DONE")
        );
    }



    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateNationalityRequest $request, $id)
    {

        $preData = UpdateNationalityAction::execute($request->getData());

        $updatedData = $this->nationalityService->updateNationality($id, $preData);

        $returnData = NationalityResource::make($updatedData);

        return ApiResponseHelper::sendResponse(
            new Result($returnData, "Done")
        );
    }

    public function destroy($id)
    {
        $deleteData = $this->nationalityService->deleteNationality($id);

        return ApiResponseHelper::sendSuccessResponse(new SuccessResult("deleted"));
    }
}
