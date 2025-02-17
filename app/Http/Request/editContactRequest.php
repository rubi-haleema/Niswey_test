<?php

namespace App\Http\Request;

use Illuminate\Foundation\Http\FormRequest;

class editContactRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
        // 'unique:table_name,column_name,'.$this->id.',id'

    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name' => 'required',
            'phone' => 'required|unique:contacts,phone_number,' . $this->id . ',id',
        ];
    }
}