<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreProductRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'category_id' => 'required|exists:categories,id',
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'price' => 'required|numeric',
            'image' => 'nullable|file|mimes:jpg,jpeg,png|max:5120',
        ];
    }

    public function messages(): array
    {
        return [
            'category_id.required' => 'Kategoriya ID majburiy',
            'category_id.exists' => 'Bunday kategoriya mavjud emas',
            'title.required' => 'Sarlavha majburiy',
            'description.required' => 'Matn majburiy',
            'price.required' => 'Narx majburiy',
            'image.mimes' => 'Rasm faqat jpg, jpeg, png formatida bo‘lishi kerak',
        ];
    }
}
