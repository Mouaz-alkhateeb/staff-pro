<?php

namespace App\Http\Controllers;

use App\Application\Helpers\ApiHelper\ApiResponseHelper;
use App\Application\Helpers\ApiHelper\Result;
use App\Application\Helpers\ApiHelper\SuccessResult;
use App\Application\Services\Media\MediaService;
use App\Domain\Action\Media\CreateMediaAction;
use App\Http\Requests\Media\CreateMediaRequest;
use App\Http\Requests\Media\GetMediaRequest;
use App\Http\Resources\Media\MediaListResource;
use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Collection;


class MediaController extends Controller
{
    public function __construct(private MediaService $mediaService) {}

    public function store(CreateMediaRequest $request)
    {
        $preData = CreateMediaAction::execute($request->getData());
        $media = $this->mediaService->createMedia($preData, $request->getFiles());

        return ApiResponseHelper::sendResponse(
            new Result(MediaListResource::collection($media ?? new Collection()), null, "Done")
        );
    }

    public function delete($id)
    {
        $this->mediaService->deleteMedia($id);
        return ApiResponseHelper::sendSuccessResponse(
            new SuccessResult("Deleted Successfully",)
        );
    }

    public function getFiles(GetMediaRequest $request)
    {
        $media = $this->mediaService->getMedia($request->getData());
        $returnData = MediaListResource::collection($media);
        return ApiResponseHelper::sendResponse(
            new Result($returnData, "DONE")
        );
    }
}
