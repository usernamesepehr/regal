<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class commentRequest extends FormRequest
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
            'title' => 'required|string|max:255|min:3',
            'product_id' => 'required|integer|exists:products,id',
            'content' => 'required|string|min:10|max:255' 
        ];
    }
    public function messages()
    {
        return [
            'title.required' => 'فیلد عنوان الزامی است.',
            'title.string'   => 'عنوان باید به صورت متن وارد شود.',
            'title.min'      => 'عنوان باید حداقل ۳ کاراکتر باشد.',
            'title.max'      => 'عنوان نمی‌تواند بیشتر از ۲۵۵ کاراکتر باشد.',

            'product_id.required' => 'انتخاب محصول الزامی است.',
            'product_id.integer'  => 'شناسه محصول باید عدد باشد.',
            'product_id.exists'   => 'محصول انتخاب شده معتبر نیست.',

            'content.required' => 'محتوا الزامی است.',
            'content.string'   => 'محتوا باید به صورت متن وارد شود.',
            'content.min'      => 'محتوا باید حداقل ۱۰ کاراکتر باشد.',
            'content.max'      => 'محتوا نمی‌تواند بیشتر از ۲۵۵ کاراکتر باشد.',
        ];
    }
}
