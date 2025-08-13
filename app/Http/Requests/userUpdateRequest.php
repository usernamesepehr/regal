<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class userUpdateRequest extends FormRequest
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
            'name' => 'sometimes|string|max:255|min:4',
            'email' => 'sometimes|email|unique:users,email',
            'kodposti' => 'sometimes|digits:10',
            'city' => 'sometimes|string|max:100',
            'profile' => 'sometimes|mimes:png,jpg,jpeg|image|max:2048',
            'address' => 'sometimes|string|max:500'
        ];
    }
    public function messages()
    {
        return [
            'name.string' => 'نام باید شامل حروف باشد.',
            'name.min' => 'نام باید حداقل ۴ حرف باشد.',
            'name.max' => 'نام نمی‌تواند بیشتر از ۲۵۵ حرف باشد.',
    
            'email.email' => 'ایمیل وارد شده معتبر نیست.',
            'email.unique' => 'این ایمیل قبلاً ثبت شده است.',
    
            'kodposti.digits' => 'کد پستی باید دقیقا ۱۰ رقم باشد.',
    
            'city.string' => 'نام شهر باید از نوع رشته‌ای باشد.',
            'city.max' => 'نام شهر نمی‌تواند بیشتر از ۱۰۰ حرف باشد.',
    
            'profile.mimes' => 'فرمت تصویر باید png، jpg یا jpeg باشد.',
            'profile.image' => 'فایل آپلودی باید تصویر باشد.',
            'profile.max' => 'حجم تصویر نباید بیشتر از ۲ مگابایت باشد.',
    
            'address.string' => 'آدرس باید از نوع رشته‌ای باشد.',
            'address.max' => 'آدرس نمی‌تواند بیشتر از ۵۰۰ کاراکتر باشد.',
        ];
    }
}
