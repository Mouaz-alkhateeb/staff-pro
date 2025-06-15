<?php

namespace App\Http\Controllers;

use App\Application\Helpers\ApiHelper\ApiResponseHelper;
use App\Application\Helpers\ApiHelper\Result;
use App\Application\Helpers\ApiHelper\SuccessResult;
use App\Application\Services\Room\RoomService;
use App\Domain\Action\Room\CreateRoomAction;
use App\Domain\Action\Room\UpdateRoomAction;
use App\Http\Requests\Room\CreateRoomRequest;
use App\Http\Requests\Room\GetRoomListRequest;
use App\Http\Requests\Room\UpdateRoomRequest;
use App\Http\Resources\PaginationResource;
use App\Http\Resources\Room\RoomResource;
use Illuminate\Http\Request;

class RoomController extends Controller
{
    public function __construct(
        private RoomService $roomService
    ) {}

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $getData = $this->roomService->getRoom();
        $returnData = RoomResource::collection($getData);
        $pagination = PaginationResource::make($getData);
        return ApiResponseHelper::sendResponseWithPagination(
            new Result($returnData, $pagination, "Done")
        );
    }

    public function getRoomList(GetRoomListRequest $request)
    {
        $data = $this->roomService->getRooms($request->generateFilter());
        $returnData = RoomResource::collection($data);
        $pagination = PaginationResource::make($data);
        return ApiResponseHelper::sendResponseWithPagination(
            new Result($returnData, $pagination, "DONE")
        );
    }


    public function store(CreateRoomRequest $request)
    {
        $preData = CreateRoomAction::execute($request->getData());

        $createdData = $this->roomService->createRoom($preData);

        $returnData = RoomResource::make($createdData);

        return ApiResponseHelper::sendResponse(
            new Result($returnData, "Done")
        );
    }
    public function show($id)
    {
        $showCity = $this->roomService->showRoom($id);
        $returnData = RoomResource::make($showCity);
        return ApiResponseHelper::sendResponse(
            new Result($returnData,  "DONE")
        );
    }
    public function update(UpdateRoomRequest $request, $id)
    {

        $preData = UpdateRoomAction::execute($request->getData());

        $updatedData = $this->roomService->updateRoom($id, $preData);

        $returnData = RoomResource::make($updatedData);

        return ApiResponseHelper::sendResponse(
            new Result($returnData, "Updated")
        );
    }

    public function destroy($id)
    {
        $deleteData = $this->roomService->deleteRoom($id);

        return ApiResponseHelper::sendSuccessResponse(new SuccessResult("deleted"));
    }
}
