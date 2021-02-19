<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class BaseFilterRequest extends FormRequest
{

    protected $filter = [
        'page' => 'integer',
        'per_page' => 'integer'
    ];
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
        return $this->filter;
    }

    public function messages()
    {
       return [];
    }
}
