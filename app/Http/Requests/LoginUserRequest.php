<?php


namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class LoginUserRequest extends FormRequest
{
    public function authorize()
    {
    // Ensure the user is allowed to make this request
    return true;
    }

    public function rules()
    {
        return [

            'login' => [
                'required',
                'string',
                function ($attribute, $value, $fail) {
                    // Check if the input is a valid email
                    if (!filter_var($value, FILTER_VALIDATE_EMAIL) && !preg_match('/^\+?[0-9]{10,15}$/', $value)) {
                        return $fail('The ' . $attribute . ' must be a valid email or phone number.');
                    }
                }
            ],
            'password' => 'required|string',
        ];
    }

    public function messages()
    {
        return [
            'login.required' => 'Email or Phone is required.',
            'password.required' => 'Password is required.',
        ];
    }
}
