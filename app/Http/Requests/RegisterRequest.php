<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RegisterRequest extends FormRequest
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
            'name' => 'required|string|max:255|min:4',
            'phone' => 'required|digits:11',
            'password' => 'required|min:8|max:255|regex:/^[a-zA-Z0-9]+$/',
            'email' => 'required|email|unique:users,email',
            'kodposti' => 'required|digits:10',
            'city' => 'required|string|max:100',
            'profile' => 'required|mimes:png,jpg,jpeg|image|max:2048',
            'address' => 'required|string|max:500'
        ];
    }
    public function messages(): array
    {
        return [
            'name.required' => 'وارد کردن نام الزامی است.',
            'name.string' => 'نام باید شامل حروف باشد.',
            'name.min' => 'نام باید حداقل ۴ حرف باشد.',
            'name.max' => 'نام نمی‌تواند بیشتر از ۲۵۵ حرف باشد.',
    
            'phone.required' => 'شماره تلفن الزامی است.',
            'phone.digits' => 'شماره تلفن باید دقیقا ۱۱ رقم باشد.',
    
            'password.required' => 'رمز عبور الزامی است.',
            'password.min' => 'رمز عبور باید حداقل ۸ کاراکتر باشد.',
            'password.max' => 'رمز عبور نمی‌تواند بیشتر از ۲۵۵ کاراکتر باشد.',
            'password.regex' => 'رمز عبور فقط می‌تواند شامل حروف و اعداد باشد.',
    
            'email.required' => 'وارد کردن ایمیل الزامی است.',
            'email.email' => 'ایمیل وارد شده معتبر نیست.',
            'email.unique' => 'این ایمیل قبلاً ثبت شده است.',
    
            'kodposti.required' => 'کد پستی الزامی است.',
            'kodposti.digits' => 'کد پستی باید دقیقا ۱۰ رقم باشد.',
    
            'city.required' => 'نام شهر الزامی است.',
            'city.string' => 'نام شهر باید از نوع رشته‌ای باشد.',
            'city.max' => 'نام شهر نمی‌تواند بیشتر از ۱۰۰ حرف باشد.',
    
            'profile.required' => 'آپلود تصویر پروفایل الزامی است.',
            'profile.mimes' => 'فرمت تصویر باید png، jpg یا jpeg باشد.',
            'profile.image' => 'فایل آپلودی باید تصویر باشد.',
            'profile.max' => 'حجم تصویر نباید بیشتر از ۲ مگابایت باشد.',
    
            'address.required' => 'آدرس الزامی است.',
            'address.string' => 'آدرس باید از نوع رشته‌ای باشد.',
            'address.max' => 'آدرس نمی‌تواند بیشتر از ۵۰۰ کاراکتر باشد.',
        ];
    }
}
