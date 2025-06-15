<?php

namespace App\Http\Requests\User;

use App\Domain\DTO\User\ChangeUserStatusDTO;
use Illuminate\Foundation\Http\FormRequest;

class ChangeUserStatusRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules()
    {
        return [
            'user_status_id' => 'required|exists:user_statuses,id'
        ];
    }

    public function getData(): ChangeUserStatusDTO
    {
        $data = new ChangeUserStatusDTO();
        $data->setUserStatusId($this->input('user_status_id'));
        return $data;
    }
}