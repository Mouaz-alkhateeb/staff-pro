<?php

namespace App\Http\Resources\Role;

use App\Http\Resources\Permission\PermissionResource;
use App\Http\Resources\User\CreatedByResource;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class RoleResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'status' => $this->status,
            'display_name' => $this->display_name,
            'description' => $this->description,
            'users_count' => $this->users_count ? $this->users_count : null,
            'created_at' => $this->created_at->format('Y-m-d'),
            'created_by' => CreatedByResource::make($this->whenloaded('createdByUser')),
            'permissions'  => PermissionResource::collection($this->whenloaded('permissions')),
        ];
    }
}
