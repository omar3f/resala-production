<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;

class StoreDonorRequest extends Request
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
            //
            'first_name' => 'required',
            'last_name' => 'required',
            'phone' => 'required',
            'email' => 'required|email',
            'governorate_id' => 'required',
            'blood_id' => 'required'
        ];
    }
    public function fullName($first_name_field, $last_name_field) {
        return $this[$first_name_field] . ' ' . $this[$last_name_field];
    }
}
