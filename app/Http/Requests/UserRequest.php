<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;

class UserRequest extends FormRequest
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
            'name'           => 'required|min:2|max:255',
            'email'          => 'nullable|email:filter|min:2|max:255|unique:users',
            'password'       => 'required|min:6|max:255',
            'phone'          => ['required','unique:users','regex:/05\d{8}/u'],
            'emergency'      => ['nullable','regex:/05\d{8}/u'],
            'country_id'     => 'nullable|exists:countries,id',
            'city_id'        => 'nullable|exists:cities,id',
            'birthday'       => 'nullable|date',
            'nationality_id' => 'nullable|exists:nationalities,id',
            'gender'         => 'nullable|in:male,female',
            'image'          => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:20048',
            'type_id'        => 'nullable|exists:types,id',
            'address'        => 'nullable|min:2|max:255',
            'bio'            => 'nullable|min:2|max:255',
            'units'          => 'nullable|numeric',
        ];
    }
    protected function failedValidation(Validator $validator) {
        if ($this->wantsJson()) {
            throw new HttpResponseException(response()->json( api_response( 0 , $validator->errors()->first()), 400));
        }
        parent::failedValidation($validator);
    }
}
