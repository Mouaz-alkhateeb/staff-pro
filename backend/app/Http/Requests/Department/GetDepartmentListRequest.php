<?php

namespace App\Http\Requests\Department;

use App\Domain\Filter\Department\DepartmentFilter;
use Illuminate\Foundation\Http\FormRequest;

class GetDepartmentListRequest extends FormRequest
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
        $departmentFilter = new DepartmentFilter();

        if ($this->filled('name')) {
            $departmentFilter->setName($this->input('name'));
        }
        if ($this->filled('status')) {
            $departmentFilter->setStatus($this->input('status'));
        }
        if ($this->filled('order_by')) {
            $departmentFilter->setOrderBy($this->input('order_by'));
        }
        if ($this->filled('order')) {
            $departmentFilter->setOrder($this->input('order'));
        }
        if ($this->filled('per_page')) {
            $departmentFilter->setPerPage($this->input('per_page'));
        }
        return $departmentFilter;
    }
}