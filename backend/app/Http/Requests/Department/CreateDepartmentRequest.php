<?php

namespace App\Http\Requests\Department;

use App\Domain\DTO\Department\CreateDepartmentDTO;
use App\Domain\Rules\Department\CreateDepartmentRules;
use Illuminate\Foundation\Http\FormRequest;

class CreateDepartmentRequest extends FormRequest
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
        return CreateDepartmentRules::rules();
    }

    public function getData()
    {
        $data = new CreateDepartmentDTO();
        $data->setName($this->input('name'));
        if ($this->filled(('status'))) {
            $data->setStatus($this->input('status'));
        }
        return $data;
    }
}