<?php

namespace App\Http\Requests\User;

use App\Domain\DTO\User\CreateUserDTO;
use App\Domain\Rules\User\CreateUserRules;
use Illuminate\Foundation\Http\FormRequest;

class CreateUserRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    public function rules()
    {

        return CreateUserRules::rules();
    }

    public function getData()
    {
        $data = new CreateUserDTO();
        $data->setFirstName($this->input('first_name'));
        if ($this->filled('last_name')) {
            $data->setLastName($this->input('last_name'));
        }
        $data->setGender($this->input('gender'));
        if ($this->filled('birth_date')) {
            $data->setBirthDate($this->input('birth_date'));
        }
        if ($this->filled('address')) {
            $data->setAddress($this->input('address'));
        }
        if ($this->filled('birth_date')) {
            $data->setBirthDate($this->input('birth_date'));
        }
        $data->setPhoneNumber("963" . $this->input('phone_number'));
        $data->setPassword($this->input('password'));
        if ($this->filled('room_id')) {
            $data->setRoomId($this->input('room_id'));
        }
        if ($this->filled('city_id')) {
            $data->setCityId($this->input('city_id'));
        }
        if ($this->filled('user_status_id')) {
            $data->setUserStatusId($this->input('user_status_id'));
        }
        return $data;
    }
}
