<?php

namespace App\Http\Requests\UserStatus;

use App\Domain\DTO\UserStatus\CreateUserStatusDTO;
use App\Domain\Rules\UserStatus\CreateUserStatusRules;
use Illuminate\Foundation\Http\FormRequest;

class CreateUserStatusRequest extends FormRequest
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
        return CreateUserStatusRules::rules();
    }

    public function getData()
    {
        $data = new CreateUserStatusDTO();
        $data->setName($this->input('name'));
        return $data;
    }
}