<?php

namespace App\Http\Controllers;

use App\Application\Helpers\ApiHelper\ApiResponseHelper;
use App\Application\Helpers\ApiHelper\Result;
use App\Application\Helpers\ApiHelper\SuccessResult;
use App\Application\Services\City\CityService;
use App\Domain\Action\City\CreateCityAction;
use App\Domain\Action\City\UpdateCityAction;
use App\Http\Requests\City\CreateCityRequest;
use App\Http\Requests\City\GetCitiesRequest;
use App\Http\Requests\City\UpdateCityRequest;
use App\Http\Resources\City\CityResource;
use App\Http\Resources\PaginationResource;
use Illuminate\Http\Request;

class CityController extends Controller
{
    public function __construct(private CityService $cityService) {}

    public function index(GetCitiesRequest $request)
    {
        $data = $this->cityService->getCities($request->generateFilter());
        $returnData = CityResource::collection($data);
        $pagination = PaginationResource::make($data);
        return ApiResponseHelper::sendResponseWithPagination(
            new Result($returnData, $pagination, "DONE")
        );
    }

    public function getCitiesList(GetCitiesRequest $request)
    {
        $data = $this->cityService->getCities($request->generateFilter());

        $returnData = CityResource::collection($data);
        $pagination = PaginationResource::make($data);
        return ApiResponseHelper::sendResponseWithPagination(
            new Result($returnData, $pagination, "DONE")
        );
    }

    public function store(CreateCityRequest $request)
    {
        $preData = CreateCityAction::execute($request->getData());
        $createdData = $this->cityService->createCity($preData);

        $returnData = CityResource::make($createdData);

        return ApiResponseHelper::sendResponse(
            new Result($returnData, "Done")
        );
    }

    public function show($id)
    {
        $showCity = $this->cityService->showCity($id);
        $returnData = CityResource::make($showCity);
        return ApiResponseHelper::sendResponse(
            new Result($returnData,  "DONE")
        );
    }

    public function update(UpdateCityRequest $request, $id)
    {


        $preData = UpdateCityAction::execute($request->getData());

        $updatedData = $this->cityService->updateCity($id, $preData);

        $returnData = CityResource::make($updatedData);

        return ApiResponseHelper::sendResponse(
            new Result($returnData, "Done")
        );
    }

    public function destroy($id)
    {
        $deleteData = $this->cityService->deleteCity($id);

        return ApiResponseHelper::sendSuccessResponse(new SuccessResult("deleted"));
    }
}
