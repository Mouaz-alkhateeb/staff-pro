<?php

namespace App\Http\Requests\Role;

use App\Domain\DTO\Role\UpdateRoleDTO;
use App\Domain\Rules\Role\UpdateRoleRules;
use Illuminate\Foundation\Http\FormRequest;

class UpdateRoleRequest extends FormRequest
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
        return UpdateRoleRules::rules();
    }

    public function getPermissions()
    {
        $data = new UpdateRoleDTO();
        $data->setPermissions($this->input('permissions'));
        return $data;
    }
}
