<?php

namespace App\Domain\DTO\Media;

class CreateMediaDTO extends \Spatie\LaravelData\Data
{
    public ?int $model_id = null;
    public ?string $model_type = null;
    public ?string $name = null;
    public ?string $file_name = null;
    public ?string $mime_type = null;
    public ?string $disk = null;
    public ?int $size = null;
    public ?bool $is_featured = false;
    public ?int $uploaded_by = null;

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

    /**
     * @param string|null $name
     */
    public function setName(?string $name): void
    {
        $this->name = $name;
    }

    /**
     * @param string|null $file_name
     */
    public function setFileName(?string $file_name): void
    {
        $this->file_name = $file_name;
    }

    /**
     * @param string|null $mime_type
     */
    public function setMimeType(?string $mime_type): void
    {
        $this->mime_type = $mime_type;
    }
    public function getMimeType(): ?string
    {
        return $this->mime_type;
    }

    /**
     * @param string|null $disk
     */
    public function setDisk(?string $disk): void
    {
        $this->disk = $disk;
    }

    /**
     * @param string|null $size
     */
    public function setSize(?string $size): void
    {
        $this->size = $size;
    }
    public function getSize(): ?int
    {
        return $this->size;
    }

    public function setIsFeatured(?string $is_featured): void
    {
        if ($is_featured == 'true') {
            $this->is_featured = true;
        } else {
            $this->is_featured = false;
        }
    }

    public function getIsFeatured(): ?bool
    {
        return $this->is_featured;
    }
    public function setUploadedBy(?int $uploaded_by): void
    {
        $this->uploaded_by = $uploaded_by;
    }
    public function getUploadedBy(): ?int
    {
        return $this->uploaded_by;
    }
}