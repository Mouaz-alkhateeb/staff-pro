<?php

namespace App\Http\Requests\Nationality;

use App\Domain\DTO\Nationality\CreateNationalityDTO;
use App\Domain\Rules\Nationality\CreateNationalityRules;
use Illuminate\Foundation\Http\FormRequest;

class CreateNationalityRequest extends FormRequest
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
        return CreateNationalityRules::rules();
    }

    public function getData()
    {
        $data = new CreateNationalityDTO();
        $data->setName($this->input('name'));
        if ($this->filled('status')) {
            $data->setStatus($this->input('status'));
        }

        return $data;
    }
}