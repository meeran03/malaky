<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;

class OrderRequest extends FormRequest
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
            'receiver_id'   => 'required|exists:users,id',
            'children'      => 'required|array',
            'children.*'    => 'exists:childrens,id',
            'from'          => 'required|date_format:Y-m-d H:i:s|after_or_equal:today',
            'to'            => 'required|date_format:Y-m-d H:i:s|after:from',
//            'date'          => 'required|date|date_format:Y-m-d|after_or_equal:today',
            'details'       => 'nullable|min:2|max:255',
        ];
    }
    protected function failedValidation(Validator $validator) {
        if ($this->wantsJson()) {
            throw new HttpResponseException(response()->json( api_response( 0 , $validator->errors()->first()), 400));
        }
        parent::failedValidation($validator);
    }
}
