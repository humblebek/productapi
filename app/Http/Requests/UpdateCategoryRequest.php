<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateCategoryRequest extends FormRequest
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
            'title' => 'nullable|string|max:255',
            'description' => 'nullable|string',
            'image' => 'nullable|file|mimes:jpg,jpeg,png|max:5120',
        ];
    }


    public function messages(): array
    {
        return [
            'title.required' => 'Sarlavha majburiy.',
            'title.string' => 'Sarlavha matn bo‘lishi kerak.',
            'title.max' => 'Sarlavha uzunligi 255 belgidan oshmasligi kerak.',

            'description.string' => 'Tavsif matn bo‘lishi kerak.',

            'image.file' => 'Rasm fayl bo‘lishi kerak.',
            'image.mimes' => 'Rasm faqat jpg, jpeg, png yoki gif formatida bo‘lishi kerak.',
            'image.max' => 'Rasm hajmi 5MB dan oshmasligi kerak.',
        ];
    }
}
