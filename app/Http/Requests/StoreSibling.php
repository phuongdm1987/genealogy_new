<?php

namespace Genealogy\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreSibling extends FormRequest
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
            'parent_id' => 'required|exists:users,id',
            'avatar'    => 'nullable|image|mimes:jpeg,jpg,png',
            'name'      => 'required',
            'email'     => 'required|email|unique:users,email',
            'sex'       => 'required|boolean',
            'dob'       => 'nullable|date_format:Y-m-d',
            'dod'       => 'nullable|date_format:Y-m-d',
        ];
    }
}
