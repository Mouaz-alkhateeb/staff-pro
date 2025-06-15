<?php

namespace App\Http\Requests\Role;

use App\Domain\Filter\Role\RoleFilter;
use Illuminate\Foundation\Http\FormRequest;

class GetRoleListRequest extends FormRequest
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
        $roleFilter = new RoleFilter();
        if ($this->filled('name')) {
            $roleFilter->setName($this->input('name'));
        }
        if ($this->filled('order_by')) {
            $roleFilter->setOrderBy($this->input('order_by'));
        } else {
            $roleFilter->setOrderBy('created_at');
        }

        if ($this->filled('order')) {
            $roleFilter->setOrder($this->input('order'));
        } else {
            $roleFilter->setOrder('DESC');
        }

        if ($this->filled('per_page')) {
            $roleFilter->setPerPage($this->input('per_page'));
        }
        return $roleFilter;
    }
}
