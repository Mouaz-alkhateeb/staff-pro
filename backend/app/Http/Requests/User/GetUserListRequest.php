<?php

namespace App\Http\Requests\User;

use App\Domain\Filter\User\UserFilter;
use Illuminate\Foundation\Http\FormRequest;

class GetUserListRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            //
        ];
    }

    public function generateFilter()
    {
        $userFilter = new UserFilter();
        if ($this->filled('name')) {
            $userFilter->setFirstName($this->input('name'));
            $userFilter->setLastName($this->input('name'));
        }
        if ($this->filled('gender')) {
            $userFilter->setGender($this->input('gender'));
        }
        if ($this->filled('phone_number')) {
            $userFilter->setPhoneNumber($this->input('phone_number'));
        }
        if ($this->filled('city_id')) {
            $userFilter->setCityId($this->input('city_id'));
        }
        if ($this->filled('user_status_id')) {
            $userFilter->setStatusId($this->input('user_status_id'));
        }
        if ($this->filled('room_id')) {
            $userFilter->setRoomId($this->input('room_id'));
        }
        if ($this->filled('order_by')) {
            $userFilter->setOrderBy($this->input('order_by'));
        }
        if ($this->filled('order')) {
            $userFilter->setOrder($this->input('order'));
        }
        if ($this->filled('per_page')) {
            $userFilter->setPerPage($this->input('per_page'));
        }
        return $userFilter;
    }
}