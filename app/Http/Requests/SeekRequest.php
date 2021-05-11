<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;

class SeekRequest extends FormRequest
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
        api_lang();
        return [
            'service_id'   => 'required|exists:services,id',
            'name'         => 'required|min:2|max:255',
            'email'        => 'required|email|min:2|max:255',
            'phone'        => ['required','regex:/05\d{8}/u'],
            'case_name'    => 'required|min:2|max:255',
            'case_age'     => 'required|numeric|min:1|max:150',
            'details'      => 'nullable|min:2|max:255',
            'attach'       => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:20048',
        ];
    }
    protected function failedValidation(Validator $validator) {
        if ($this->wantsJson()) {
            throw new HttpResponseException(response()->json( api_response( 0 , $validator->errors()->first()), 400));
        }
        parent::failedValidation($validator);
    }
}
