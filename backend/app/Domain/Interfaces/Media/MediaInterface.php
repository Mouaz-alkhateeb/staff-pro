<?php

namespace App\Domain\Interfaces\Media;

use App\Domain\DTO\Media\CreateMediaDTO;
use App\Domain\DTO\Media\GetMediaDTO;

interface MediaInterface
{
    public function createMedia(CreateMediaDTO $createMediaDTO, $files);
    public function getMedia(GetMediaDTO $media);
}