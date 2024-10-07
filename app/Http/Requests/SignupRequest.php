<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class SignupRequest extends FormRequest
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
            'name'         => ['required', 'string', 'max:255'],
            'email'        => request('phone') ? ['nullable', 'string', 'email', 'max:255', Rule::unique("users", "email")->where('is_guest', 10)] : ['required', 'string', 'email', 'max:255', Rule::unique("users", "email")->where('is_guest', 10)],
            'phone'        => request('email') ? ['nullable', 'string', 'max:20'] : ['required', 'string', 'max:20'],
            'country_code' => request('email') ? ['nullable', 'string', 'max:10'] : ['required', 'string', 'max:10'],
            'password'     => ['required', 'string', 'min:6'],
        ];
    }
}
