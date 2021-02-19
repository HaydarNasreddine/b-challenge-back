<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserFilterRequest extends BaseFilterRequest
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
        $this->filter['id'] = 'integer';
        $this->filter['email'] = 'string|email|max:255';
        $this->filter['name'] = 'string';
        return $this->filter;
    }

    public function messages()
    {
        return [];
    }
}
