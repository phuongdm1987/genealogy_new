<?php

namespace Genealogy\Http\Requests;

use Genealogy\Rules\PhoneNumber;
use Illuminate\Foundation\Http\FormRequest;

class UpdateProfile extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return auth()->user();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'avatar' => 'nullable|image|mimes:jpeg,jpg,png',
            'phone'  => ['nullable', new PhoneNumber],
            'name'   => 'required',
            'sex'    => 'required|boolean',
            'dob'    => 'nullable|date_format:Y-m-d',
            'dod'    => 'nullable|date_format:Y-m-d',
        ];
    }
}
