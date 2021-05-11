<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;

class ChildRequest extends FormRequest
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
            'title'          => 'required|min:2|max:255',
            'years'          => 'required|numeric|min:0|max:12',
            'months'         => 'required|numeric|min:0|max:12',
            'medicine'       => 'required|numeric|min:0|max:1',
            'notes'          => 'nullable|min:2|max:500',
        ];
    }
    protected function failedValidation(Validator $validator) {
        if ($this->wantsJson()) {
            throw new HttpResponseException(response()->json( api_response( 0 , $validator->errors()->first()), 400));
        }
        parent::failedValidation($validator);
    }
}
