<?php

namespace App\Http\Requests;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;

class CodeRequest extends FormRequest
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
//            'email' => 'required|exists:users,email',
            'phone' => 'required|exists:users,phone',
        ];
    }

    protected function failedValidation(Validator $validator) {
        if ($this->wantsJson()) {
            throw new HttpResponseException(response()->json( api_response( 0 , $validator->errors()->first()), 400));
        }
        parent::failedValidation($validator);
    }
}
