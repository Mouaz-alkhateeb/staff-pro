<?php

namespace App\Domain\Rules\Media;


class CreateMediaRules
{
    public static function rules(): array
    {
        return [
            'model_id' => 'required',
            'model_type' => 'required',
            'is_featured' => 'string|sometimes',
        ];
    }
}
