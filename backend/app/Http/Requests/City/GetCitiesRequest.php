<?php

namespace App\Http\Requests\City;

use App\Domain\Filter\City\CityFilter;
use Illuminate\Foundation\Http\FormRequest;

class GetCitiesRequest extends FormRequest
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
        $cityFilter = new CityFilter();

        if ($this->input('name') && $this->input('name') != null) {
            $cityFilter->setName($this->input('name'));
        }
        if ($this->filled('status')) {
            $cityFilter->setStatus($this->input('status'));
        }

        if ($this->filled('order_by')) {
            $cityFilter->setOrderBy($this->input('order_by'));
        }

        if ($this->filled('order')) {
            $cityFilter->setOrder($this->input('order'));
        }

        if ($this->filled('per_page')) {
            $cityFilter->setPerPage($this->input('per_page'));
        }
        return $cityFilter;
    }
}