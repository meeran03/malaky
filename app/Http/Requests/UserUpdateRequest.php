<?php

namespace App\Http\Requests;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Support\Facades\Auth;

class UserUpdateRequest extends FormRequest
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
        if ($this->wantsJson()) {
            $this -> user = Auth::user();
        }
        api_lang();
        if ($this->request->has('suspend')){
            return [
                'suspend'           => 'required|in:0,1',
            ];
        }else{

            return [
                'name'           => 'required|min:2|max:255',
                'email'          => 'nullable|email:filter|min:2|max:255|unique:users,email,'.$this->user->id,
                'password'       => 'nullable|min:6|max:255',
                'phone'          => 'nullable|min:2|max:255|unique:users,phone,'.$this->user->id,
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

    }
    protected function failedValidation(Validator $validator) {
        if ($this->wantsJson()) {
            throw new HttpResponseException(response()->json( api_response( 0 , $validator->errors()->first()), 400));
        }
        parent::failedValidation($validator);
    }
}
