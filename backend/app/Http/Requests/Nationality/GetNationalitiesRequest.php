<?php

namespace App\Http\Requests\Nationality;

use App\Domain\Filter\Nationality\NationalityFilter;
use Illuminate\Foundation\Http\FormRequest;

class GetNationalitiesRequest extends FormRequest
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
        return [];
    }

    public function generateFilter()
    {
        $nationalityFilter = new NationalityFilter();

        if ($this->input('name') && $this->input('name') != null) {
            $nationalityFilter->setName($this->input('name'));
        }
        if ($this->filled('status')) {
            $nationalityFilter->setStatus($this->input('status'));
        }

        if ($this->filled('order_by')) {
            $nationalityFilter->setOrderBy($this->input('order_by'));
        }

        if ($this->filled('order')) {
            $nationalityFilter->setOrder($this->input('order'));
        }
        if ($this->filled('per_page')) {
            $nationalityFilter->setPerPage($this->input('per_page'));
        }

        return $nationalityFilter;
    }
}