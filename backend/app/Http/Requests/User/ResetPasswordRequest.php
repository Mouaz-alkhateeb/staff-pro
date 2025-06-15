<?php

namespace App\Http\Requests\User;

use App\Domain\DTO\User\ResetPasswordDTO;
use Illuminate\Foundation\Http\FormRequest;

class ResetPasswordRequest extends FormRequest
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
        return [
            'user_id' => 'required|exists:users,id',
        ];
    }

    public function getData()
    {
        $data = new ResetPasswordDTO();
        $data->setUserId($this->input('user_id'));
        return $data;
    }
}