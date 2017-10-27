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
            'parent_id' => 'nullable|exists:users,id|not_in:' . auth()->id(),
            'avatar' => 'nullable|image|mimes:jpeg,jpg,png',
            'phone'  => ['nullable', new PhoneNumber],
            'name'   => 'required',
            'dob'    => 'nullable|date_format:Y-m-d',
        ];
    }
}
