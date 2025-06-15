<?php

namespace App\Http\Requests\Media;

use App\Domain\DTO\Media\GetMediaDTO;
use App\Domain\Rules\Media\GetMediaRules;
use Illuminate\Foundation\Http\FormRequest;

class GetMediaRequest extends FormRequest
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
        return GetMediaRules::rules();
    }

    public function getData()
    {
        $mediaDTO = new GetMediaDTO();
        $mediaDTO->setModelId($this->input('model_id'));
        $mediaDTO->setModelType($this->input('model_type'));
        if ($this->filled('is_featured')) {
            $mediaDTO->setIsFeatured($this->input('is_featured'));
        }
        return $mediaDTO;
    }
}