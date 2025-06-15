<?php

namespace App\Application\Services\Media;

use App\Domain\DTO\Media\CreateMediaDTO;
use App\Domain\Interfaces\Media\MediaInterface;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use App\Application\Helpers\UploadImageHelper;
use App\Domain\DTO\Media\GetMediaDTO;
use App\Infrastructure\Repository\Media\MediaRepository;
use Illuminate\Support\Collection;


class MediaService implements MediaInterface
{
    public function createMedia(CreateMediaDTO $createMediaDTO, $files)
    {
        $model_type = $createMediaDTO->getModelType();

        $model = $model_type::find($createMediaDTO->getModelId());
        if ($model == null)
            throw new ModelNotFoundException();

        if (isset($files)) {
            return $this->upload($files, $model, $createMediaDTO->getIsFeatured(), $createMediaDTO->getMimeType(), $createMediaDTO->getSize(), $createMediaDTO->getUploadedBy());
        }
        return null;
    }

    private function upload($gallery, $model, $is_featured, $mime_type, $size, $uploaded_by)
    {

        $imagesMimeTypes = ['image/jpeg', 'image/gif', 'image/png', 'image/bmp', 'image/svg+xml'];
        $repo = new MediaRepository();
        $createdMedia = new Collection();
        if ($gallery != null && is_array($gallery)) {
            foreach ($gallery as $item) {

                try {
                    if (in_array($mime_type, $imagesMimeTypes)) {
                        $file = UploadImageHelper::uploadImage($item, $model->id, get_class($model));
                    } else {
                        $file = UploadImageHelper::updloadFile($item, $model->id, get_class($model));
                    }
                    $file->is_featured = $is_featured;
                    $file->mime_type = $mime_type;
                    $file->size = $size;
                    $file->uploaded_by = $uploaded_by;
                    $media = $repo->create($file->toArray())->load('uploadedBy');
                    $createdMedia->push($media);
                } catch (\Exception $exception) {
                    throw new \Exception($exception->getMessage());
                }
            }
        }
        return $createdMedia;
    }

    public function getMedia(GetMediaDTO $media)
    {
        $repo = new MediaRepository();
        $returnedMedia = $repo->getMedia($media);
        return $returnedMedia->load('uploadedBy');
    }

    public function deleteMedia($id)
    {
        $repo = new MediaRepository();
        $media = $repo->getById($id);
        $deleted = UploadImageHelper::removeFile($media->file_name);

        if ($deleted) {
            $repo->deleteById($id);
            return true;
        }
        return false;
    }
}