<?php

namespace App\Http\Requests\Tour;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class UserRequest extends FormRequest
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
     * @return array<string, ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            "country_id" => 'required|exists:locations,id',
            "first_name" => 'required',
            "last_name" => 'required',
            "phone" => 'required|unique:users,phone',
            "email" => 'required|unique:users,email',
        ];
    }
}
