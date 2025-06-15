<?php

namespace App\Http\Requests\Department;

use App\Domain\DTO\Department\UpdateDepartmentDTO;
use App\Domain\Rules\Department\UpdateDepartmentRules;
use Illuminate\Foundation\Http\FormRequest;

class UpdateDepartmentRequest extends FormRequest
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
        return UpdateDepartmentRules::rules();
    }

    public function getData()
    {
        $data = new UpdateDepartmentDTO();
        $data->setName($this->input('name'));
        if ($this->filled(('status'))) {
            $data->setStatus($this->input('status'));
        }
        return $data;
    }
}