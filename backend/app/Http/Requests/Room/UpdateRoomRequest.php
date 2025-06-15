<?php

namespace App\Http\Requests\Room;

use App\Domain\DTO\Room\CreateRoomDTO;
use App\Domain\DTO\Room\UpdateRoomDTO;
use App\Domain\Rules\Room\UpdateRoomRules;
use Illuminate\Foundation\Http\FormRequest;

class UpdateRoomRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return UpdateRoomRules::rules();
    }

    public function getData()
    {
        $data = new UpdateRoomDTO();
        $data->setNumber($this->input('number'));
        $data->setFloor($this->input('floor'));
        $data->setDepartmentId($this->input('department_id'));
        if ($this->filled(('status'))) {
            $data->setStatus($this->input('status'));
        }
        return $data;
    }
}