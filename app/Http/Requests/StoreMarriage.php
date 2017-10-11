<?php

namespace Genealogy\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreMarriage extends FormRequest
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
            'marriage.started_at' => 'required|date_format:Y-m-d',
            'marriage.is_end'     => 'nullable|boolean',
            'marriage.ended_at'   => 'nullable|date_format:Y-m-d',
            'user.avatar'         => 'nullable|image|mimes:jpeg,jpg,png',
            'user.name'           => 'required',
            'user.email'          => 'required|email|unique:users,email',
            'user.dob'            => 'nullable|date_format:Y-m-d',
            'user.is_dead'        => 'nullable|boolean',
            'user.dod'            => 'nullable|date_format:Y-m-d',
        ];
    }
}
