<?php

namespace App\Http\Requests\City;

use App\Domain\DTO\City\CreateCityDTO;
use App\Domain\Rules\City\CreateCityRules;
use Illuminate\Foundation\Http\FormRequest;

class CreateCityRequest extends FormRequest
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
        return CreateCityRules::rules();
    }

    public function getData()
    {
        $data = new CreateCityDTO();
        $data->setName($this->input('name'));
        if ($this->filled('status')) {
            $data->setStatus($this->input('status'));
        }

        return $data;
    }
}