<?php

namespace App\Http\Resources\Media;

use App\Http\Resources\User\CreatedByResource;
use Illuminate\Http\Resources\Json\JsonResource;

class MediaListResource extends JsonResource
{
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'model_id' => $this->model_id,
            'model_type' => $this->model_type,
            'relative_path' => $this->file_name,
            'is_featured' => $this->is_featured,
            'mime_type' => $this->mime_type,
            'size' => $this->size,
            'uploaded_by' => CreatedByResource::make($this->whenLoaded('uploadedBy')),
            'created_at' => $this->created_at->format('Y-m-d H:i'),
        ];
    }
}