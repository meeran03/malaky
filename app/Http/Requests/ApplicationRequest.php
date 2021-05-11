<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ApplicationRequest extends FormRequest
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
            'name'             => 'required|min:2|max:190',
            'identity'         => 'nullable|min:2|max:190',
            'email'            => 'nullable|email:filter|unique:users|min:2|max:255',
            'nationality_id'   => 'nullable|exists:nationalities,id',
            'phone'            => ['required','unique:users','regex:/05\d{8}/u'],
            'iban'             => 'nullable|min:2|max:255',
            'address'          => 'nullable|min:2|max:255',
            'married'          => 'nullable|numeric|between:0,1',
            'has_childrens'    => 'nullable|numeric|between:0,1',
            'childrens'        => 'nullable|required_if:has_childrens,=,1|numeric|min:1|max:10',
            'cv'               => 'nullable|mimes:csv,txt,xlx,xls,pdf,jpg,jpeg,gif,png|max:15048',
            'infection'        => 'nullable|mimes:csv,txt,xlx,xls,pdf,jpg,jpeg,gif,png|max:15048',
            'criminal'         => 'nullable|mimes:csv,txt,xlx,xls,pdf,jpg,jpeg,gif,png|max:15048',
        ];
    }
}
