<?php

namespace App\Http\Requests;

use App\Constants\Average;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UserAverageRequest extends FormRequest
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
            'option' => [Rule::in([Average::LAST_24_HOURS, Average::LAST_3_MONTHS, Average::LAST_MONTH, Average::LAST_WEEK, Average::LAST_YEAR])],
        ];
    }

    public function messages()
    {
        return [
        ];
    }
}
