<?php

namespace App\Http\Requests\User;

use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;


use App\Models\User;
use Illuminate\Validation\Rules;

class UpdateUserRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'name' => ['string', 'max:255'],
            'email' => ['email', 'max:255', Rule::unique(User::class)->ignore($this->id)],
            'phone' => ['numeric', Rule::unique(User::class)->ignore($this->id)],
            'gender' => ['in:male,female'],
            'joined_on' => ['date'],
            'address' => ['string', 'max:255'],
            'password' => ['confirmed', /*Rules\Password::defaults()*/],
            'password_confirmation' => ['same:password'],
            'role' => 'required|in:super-admin,staff',
        ];
    }
}
