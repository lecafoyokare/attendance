<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AttendanceRequest extends FormRequest
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
     * @return array
     */
    public function rules()
    {
        return [
            'clock_in' => 'required|date_format:H:i',
            'clock_out' => 'required|date_format:H:i|after:clock_in',
            'rest_start' => 'nullable|array',
            'rest_start.*' => 'required|date_format:H:i',
            'rest_end' => 'nullable|array',
            'rest_end.*' => 'required|date_format:H:i|after:rest_start.*|before_or_equal:clock_out',
            'reason' => 'required|string',
        ];
    }

    /**
     * Get the error messages for the defined validation rules.
     *
     * @return array
     */
    public function messages()
    {
        return [
            'clock_in.date_format' => '出勤時間もしくは退勤時間の入力値が不適切な値です',
            'clock_out.date_format' => '出勤時間もしくは退勤時間の入力値が不適切な値です',
            'clock_out.after' => '出勤時間もしくは退勤時間が不適切な値です',
            'rest_start.*.date_format' => '休憩時間が不適切な値です',
            'rest_start.*.required' => '休憩開始の値がありません。',
            'rest_end.*.date_format' => '休憩時間が不適切な値です',
            'rest_end.*.required' => '休憩終了の値がありません。',
            'rest_end.*.after' => '休憩時間が不適切な値です',
            'rest_end.*.before_or_equal' => '休憩時間もしくは退勤時間が不適切な値です',
            'reason.required' => '備考を記入してください'
        ];
    }
}
