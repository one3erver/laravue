<?php

namespace App\Http\Requests\Admin\Product;

use Illuminate\Foundation\Http\FormRequest;

class StoreProductRequest extends FormRequest
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
            'title' => 'required|string|max:255',
            'caption' => 'required|string|max:5000',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048', // Max size 2MB
            'image_thumbnail' => 'required|string',
            'price' => 'required|numeric|min:0',
            'stock' => 'nullable|numeric',
            'status' => 'required|boolean',
        ];
    }
    public function messages()
    {
        return [
            'title.required' => 'You must complete the title field',
            'stock.numeric' => 'You must enter a number in the stock field',
            'image.image' => 'The uploaded file must be an image',
            'price.required' => 'You must complete the price field',
            'price.numeric' => 'You must enter a number in the price field',
            'caption.required' => 'You must complete the caption field',
        ];
    }
}
