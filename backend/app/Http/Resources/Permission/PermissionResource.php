<?php

namespace App\Http\Resources\Permission;

use App\Http\Resources\Role\RoleResource;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class PermissionResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray($request)
    {
        return [
            'id'         => $this->id,
            'name'       => $this->name,
            'display_name' => $this->display_name,
            'roles'      => RoleResource::collection($this->whenloaded('roles')),
        ];
    }
}
