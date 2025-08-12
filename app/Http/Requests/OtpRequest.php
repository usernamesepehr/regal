<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class OtpRequest extends FormRequest
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
        if ($this->routeIs('otp-generate')){
        return [
            'phone' => 'required|digits:11|integer'
        ];
        }
        if ($this->routeIs('otp-check')){
        return [    
            'otp' => 'required|digits:5|integer'
        ];
        }
    return [];
    }
    public function messages()
    {
        if ($this->routeIs('otp-generate')){
            return [
                'phone.required' => 'شماره موبایل الزامی است.',
                'phone.digits' => 'شماره موبایل باید دقیقاً ۱۱ رقم باشد.'
            ];
        }
        if ($this->routeIs('otp-check')){
            return [
                'otp.required' => 'رمز عبور الزامی است.',
                'otp.digits' => 'رمز عبور باید دقیقاً ۵ رقم باشد.',
                'otp.integer' => 'رمز عبور باید عددی باشد.',
            ];
        }
       
       return []; 
    }
}
