<?php

namespace App\Http\Requests\UserStatus;

use App\Domain\DTO\UserStatus\UpdateUserStatusDTO;
use App\Domain\Rules\UserStatus\UpdateUserStatusRules;
use Illuminate\Foundation\Http\FormRequest;

class UpdateUserStatusRequest extends FormRequest
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
        return UpdateUserStatusRules::rules();
    }

    public function getData()
    {
        $data = new UpdateUserStatusDTO();
        $data->setName($this->input('name'));
        return $data;
    }
}