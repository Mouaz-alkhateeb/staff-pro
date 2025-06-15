<?php

namespace App\Http\Requests\UserStatus;

use App\Domain\Filter\UserStatus\UserStatusFilter;
use Illuminate\Foundation\Http\FormRequest;

class GetUserStatusListRequest extends FormRequest
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
            //
        ];
    }

    public function generateFilter()
    {
        $statusFilter = new UserStatusFilter();

        if ($this->filled('name')) {
            $statusFilter->setName($this->input('name'));
        }
        if ($this->filled('order_by')) {
            $statusFilter->setOrderBy($this->input('order_by'));
        }
        if ($this->filled('order')) {
            $statusFilter->setOrder($this->input('order'));
        }
        if ($this->filled('per_page')) {
            $statusFilter->setPerPage($this->input('per_page'));
        }
        return $statusFilter;
    }
}