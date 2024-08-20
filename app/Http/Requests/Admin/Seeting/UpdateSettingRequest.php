<?php

namespace App\Http\Requests\Admin\Seeting;

use Illuminate\Foundation\Http\FormRequest;

class UpdateSettingRequest extends FormRequest
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
            'telegram_id' => 'nullable|string|max:255',
            'telegram_token' => 'nullable|string|max:255',
            'landing_content' => 'nullable|string',
            'logo' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'site_title' => 'required|string|max:255',
            'wallets' => 'required|array',
            'wallets.*' => 'required|string|distinct',
        ];
    }
}
