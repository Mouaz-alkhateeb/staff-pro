<?php

namespace App\Http\Requests\User;

use App\Domain\DTO\User\SignInDTO;
use Illuminate\Foundation\Http\FormRequest;

class SignInRequest extends FormRequest
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
    public function rules(): array
    {
        return [
            'first_name' => 'required|string',
            'password' => 'required|string',
        ];
    }

    public function getData()
    {
        $signInUserData = new SignInDTO();
        $signInUserData->setPassword($this->input('password'));
        $signInUserData->setFirstName($this->input('first_name'));
        return $signInUserData;
    }
}