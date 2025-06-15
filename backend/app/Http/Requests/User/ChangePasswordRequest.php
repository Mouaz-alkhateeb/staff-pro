<?php

namespace App\Http\Requests\User;

use App\Domain\DTO\User\ChangePasswordDTO;
use App\Domain\Rules\User\CheckOldPassword;
use App\Domain\Rules\User\CheckOldPasswordIsSameAsNew;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class ChangePasswordRequest extends FormRequest
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
            'current_password' => ['required', new CheckOldPassword(Auth::id())],
            'password' => ['required', 'confirmed', 'min:8', 'regex:/^(?=.*[A-Za-z])(?=.*\d)(?=.*[@$!%*#?&])[A-Za-z\d@$!%*#?&]{8,}$/', new CheckOldPasswordIsSameAsNew(Auth::id())],
            'password_confirmation' => 'required',
            'user_id' => 'required|exists:users,id',
        ];
    }

    public function getData()
    {
        $data = new ChangePasswordDTO();
        $data->setPassword($this->input('password'));
        $data->setUserId($this->input('user_id'));
        return $data;
    }
}