<?php

namespace App\Http\Requests\User;

use App\Domain\DTO\User\CreateUserDTO;
use App\Domain\Rules\User\RegisterUserRules;
use Illuminate\Foundation\Http\FormRequest;

class RegisterUserRequest extends FormRequest
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
    public function rules()
    {
        return RegisterUserRules::rules();
    }

    public function data()
    {
        $data = new CreateUserDTO();
        $data->setFirstName($this->input('first_name'));
        $data->setLastName($this->input('last_name'));
        $data->setPassword($this->input('password'));
        $data->setPhoneNumber($this->input('phone_number'));
        return $data;
    }
}