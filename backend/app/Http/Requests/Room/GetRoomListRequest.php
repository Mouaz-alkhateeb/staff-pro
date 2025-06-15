<?php

namespace App\Http\Requests\Room;

use App\Domain\Filter\Room\RoomFilter;
use Illuminate\Foundation\Http\FormRequest;

class GetRoomListRequest extends FormRequest
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
        return [
            //
        ];
    }

    public function generateFilter()
    {
        $roomFilter = new RoomFilter();

        if ($this->filled('number')) {
            $roomFilter->setNumber($this->input('number'));
        }
        if ($this->filled('floor')) {
            $roomFilter->setFloor($this->input('floor'));
        }
        if ($this->filled('department_id')) {
            $roomFilter->setDepartmentId($this->input('department_id'));
        }
        if ($this->filled('status')) {
            $roomFilter->setStatus($this->input('status'));
        }
        if ($this->filled('order_by')) {
            $roomFilter->setOrderBy($this->input('order_by'));
        }
        if ($this->filled('order')) {
            $roomFilter->setOrder($this->input('order'));
        }
        if ($this->filled('per_page')) {
            $roomFilter->setPerPage($this->input('per_page'));
        }
        return $roomFilter;
    }
}