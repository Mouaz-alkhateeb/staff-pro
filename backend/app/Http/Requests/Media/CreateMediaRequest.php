<?php

namespace App\Http\Requests\Media;

use App\Domain\DTO\Media\CreateMediaDTO;
use App\Domain\Rules\Media\CreateMediaRules;
use Illuminate\Foundation\Http\FormRequest;

class CreateMediaRequest extends FormRequest
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
        return CreateMediaRules::rules();
    }

    public function getFiles()
    {
        return $this->file('images');
    }
    public function getData()
    {
        $mediaDTO = new CreateMediaDTO();
        $mediaDTO->setMimeType($this->file('images')[0]->getClientMimeType());
        $mediaDTO->setSize($this->file('images')[0]->getSize());

        $mediaDTO->setModelId($this->input('model_id'));
        $mediaDTO->setModelType($this->input('model_type'));
        if ($this->filled('is_featured')) {
            $mediaDTO->setIsFeatured($this->input('is_featured'));
        }
        return $mediaDTO;
    }
}