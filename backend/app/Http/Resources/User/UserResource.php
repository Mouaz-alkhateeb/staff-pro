<?php

namespace App\Http\Resources\User;

use App\Http\Resources\City\CityResource;
use App\Http\Resources\Media\MediaListResource;
use App\Http\Resources\Role\RoleResource;
use App\Http\Resources\Room\RoomResource;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class UserResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'first_name' => $this->first_name,
            'last_name' => $this->last_name,
            'gender' => $this->gender,
            'birth_date' => $this->birth_date,
            'phone_number' => $this->phone_number,
            'address' => $this->address,
            'room' => RoomResource::make($this->whenLoaded('room')),
            'city' => CityResource::make($this->whenLoaded('city')),
            'status' => UserStatusResource::make($this->whenLoaded('user_status')),
            'media' => MediaListResource::collection($this->whenLoaded('media')),
            'token' => $this->token,
            'roles' => RoleResource::collection($this->whenLoaded('roles')),
        ];
    }
}
