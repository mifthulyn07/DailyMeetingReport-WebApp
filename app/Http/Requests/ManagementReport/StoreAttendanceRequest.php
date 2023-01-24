<?php

namespace App\Http\Requests\ManagementReport;

use Illuminate\Foundation\Http\FormRequest;

class StoreAttendanceRequest extends FormRequest
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
            'user_id' => 'required|exists:users,id',
            'date' => 'required',
            'clockin' => 'required',
            'desc_clockin' => 'required',
            'status_clockin' => 'required|in:present,absence',
            // 'lateness_clockin' => 'date_format:H:i:s',
            'clockout' => 'required',
            'desc_clockout' => 'required',
            'status_clockout' => 'required|in:present, absence',
            // 'lateness_clockout' => 'date_format:H:i:s',
        ];
    }
}
