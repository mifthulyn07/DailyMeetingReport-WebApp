<?php

namespace App\Http\Requests;

use App\Models\User;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class ProfileUpdateRequest extends FormRequest
{
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
            'phone' => ['numeric', Rule::unique(User::class)->ignore($this->user()->id)],
            'gender' => ['in:male,female'],
            'joined_on' => ['date'],
            'address' => ['string', 'max:255'],
        ];
    }
}
