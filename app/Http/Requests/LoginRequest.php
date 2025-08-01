<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class LoginRequest extends FormRequest
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
            'email' => 'required|email',
            'password' => 'required|min:8|max:255|regex:/^[a-zA-Z0-9]+$/'
        ];
    }
    public function messages()
    {
        return [
          'email.required' => 'وارد کردن ایمیل الزامی است.',
          'email.email' => 'ایمیل وارد شده معتبر نیست.',

          'password.required' => 'رمز عبور الزامی است.',
          'password.min' => 'رمز عبور باید حداقل ۸ کاراکتر باشد.',
          'password.max' => 'رمز عبور نمی‌تواند بیشتر از ۲۵۵ کاراکتر باشد.',
          'password.regex' => 'رمز عبور فقط می‌تواند شامل حروف و اعداد باشد.'
        ];
    }
}
