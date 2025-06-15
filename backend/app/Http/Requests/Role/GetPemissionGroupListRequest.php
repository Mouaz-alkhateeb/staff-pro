<?php

namespace App\Http\Requests\Role;

use App\Domain\Filter\Role\PermissionGroupFilter;
use Illuminate\Foundation\Http\FormRequest;

class GetPemissionGroupListRequest extends FormRequest
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
        $filter = new PermissionGroupFilter();

        if ($this->filled('name')) {
            $filter->setName($this->input('name'));
        }
        if ($this->filled('id')) {
            $filter->setId($this->input('id'));
        }
        if ($this->filled('permission_name')) {
            $filter->setPermissionName($this->input('permission_name'));
        }
        return $filter;
    }
}
