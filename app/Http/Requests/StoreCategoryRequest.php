<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreCategoryRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'image' => 'required|file|mimes:jpg,jpeg,png,gif|max:2048',
        ];
    }

    public function messages(): array
    {
        return [
            'title.required' => 'Sarlavha majburiy.',
            'title.string' => 'Sarlavha matn bo‘lishi kerak.',
            'title.max' => 'Sarlavha uzunligi 255 belgidan oshmasligi kerak.',

            'description.string' => 'Tavsif matn bo‘lishi kerak.',
            'description.required' => 'Tavsif majburiy.',

            'image.required' => 'Rasm yuklash majburiy.',
            'image.file' => 'Rasm fayl bo‘lishi kerak.',
            'image.mimes' => 'Rasm faqat jpg, jpeg, png yoki gif formatida bo‘lishi kerak.',
            'image.max' => 'Rasm hajmi 2MB dan oshmasligi kerak.',
        ];
    }
}
