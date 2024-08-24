<?php

namespace App\Http\Requests\Admin\User;

use Illuminate\Foundation\Http\FormRequest;

class UpdateUserRequest extends FormRequest
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
            'name' => 'required|string',
            'email' => 'required|email',
            'mobile' => 'required|max:11',
            'status' => 'required|boolean',
        ];
    }
    public function messages()
    {
        return [
            'name.required' => 'You must complete the name field',
            'name.string' => 'You must use a text string',
            'email.required' => 'You must complete the email field',
            'email.email' => 'You must enter an email',
            'mobile.required' => 'You must complete the phone field',
            'mobile.numeric' => 'You must use a number',
        ];
    }
}
