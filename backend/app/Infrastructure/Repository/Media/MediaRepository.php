<?php

namespace App\Infrastructure\Repository\Media;

use App\Domain\Entity\Media;

class MediaRepository extends \App\Infrastructure\Repository\BaseRepositoryImplementation
{

    /**
     * @inheritDoc
     */
    public function model()
    {
        return Media::class;
    }

    public function getFilterItems($filter) {}
    public function getMedia($media)
    {
        $records = Media::query();
        $records->where('model_type', $media->getModelType());
        $records->where('model_id', $media->getModelId());

        $records->when(isset($media->is_featured), function ($records) use ($media) {
            $records->where('is_featured', $media->getIsFeatured());
        });
        return $records->get();
    }
}