<?php

namespace Genealogy\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreEmployment extends FormRequest
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
            'current_id' => 'required|exists:users,id',
            'company'    => 'required',
            'position'   => 'nullable',
            'is_current' => 'nullable|boolean',
            'started_at' => 'nullable|date_format:Y-m-d',
            'ended_at'   => 'nullable|date_format:Y-m-d',
        ];
    }
}
