<?php


namespace App\Application\Helpers;


use App\Application\Helpers\UploadImageHelper;
use App\Infrastructure\Repository\Media\MediaRepository;

class MediaHelper
{
    public function saveImage($image, $modelRepository, $model)
    {
        $repo = new MediaRepository();
        $image = UploadImageHelper::uploadImage($image, $model->id, get_class($model));
        $savedImage = $repo->create($image->toArray());
        $imageId = $savedImage->id;
        $modelRepository->updateById($model->id, [
            'feature_image' => $imageId
        ]);
        return $imageId;
    }

    public function uploadGallery($gallery, $model)
    {
        $repo = new MediaRepository();
        if ($gallery != null && is_array($gallery)) {
            foreach ($gallery as $item) {
                $image =  UploadImageHelper::uploadImage($item, $model->id, get_class($model));
                $repo->create($image->toArray());
            }
        }
    }
}