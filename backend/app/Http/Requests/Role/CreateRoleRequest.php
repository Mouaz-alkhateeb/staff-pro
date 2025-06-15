<?php

namespace App\Http\Requests\Role;

use App\Domain\DTO\Role\CreateRoleDTO;
use App\Domain\Rules\Role\CreateRoleRules;
use Illuminate\Foundation\Http\FormRequest;

class CreateRoleRequest extends FormRequest
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
        return CreateRoleRules::rules();
    }

    public function getRoleData()
    {
        $data = new CreateRoleDTO();
        $data->setName($this->input('name'));
        $data->setDisplayName($this->input('display_name'));
        $data->setDescription($this->input('description'));
        return $data;
    }
}
