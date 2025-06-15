<?php

namespace App\Domain\Rules\Media;


class GetMediaRules
{
    public static function rules(): array
    {
        return [
            'model_id' => 'required',
            'model_type' => 'required',
            'is_featured' => 'boolean|sometimes'
        ];
    }
}