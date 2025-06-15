<?php

namespace App\Domain\DTO\Media;

class GetMediaDTO extends \Spatie\LaravelData\Data
{
    public ?int $model_id = null;
    public ?string $model_type = null;
    public ?bool $is_featured = false;

    /**
     * @return int|null
     */
    public function getModelId(): ?int
    {
        return $this->model_id;
    }

    /**
     * @return string|null
     */
    public function getModelType(): ?string
    {
        return $this->model_type;
    }



    /**
     * @param int|null $model_id
     */
    public function setModelId(?int $model_id): void
    {
        $this->model_id = $model_id;
    }

    /**
     * @param string|null $model_type
     */
    public function setModelType(?string $model_type): void
    {
        $this->model_type = $model_type;
    }
    public function setIsFeatured(?bool $is_featured): void
    {
        $this->is_featured = $is_featured;
    }
    public function getIsFeatured(): bool
    {
        return $this->is_featured;
    }
}