<?php

namespace App\Http\Requests\ManagementReport;

use Illuminate\Foundation\Http\FormRequest;

class UpdateAttendanceRequest extends FormRequest
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
            'user_id' => 'nullable|exists:users,id',
            'date' => 'nullable',
            'clockin' => 'nullable',
            'desc_clockin' => 'nullable',
            'status_clockin' => 'nullable|in:present,absence',
            // 'lateness_clockin' => 'date_format:H:i:s',
            'clockout' => 'nullable',
            'desc_clockout' => 'nullable',
            'status_clockout' => 'nullable|in:present,absence',
            // 'lateness_clockout' => 'date_format:H:i:s',
        ];
    }
}
