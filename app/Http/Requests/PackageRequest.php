<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PackageRequest extends FormRequest
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
        if ($this->request->has('suspend')) {
            return [
                'suspend'           => 'required|in:0,1',
            ];
        }
        return [
            'ar.title'          => 'required|min:3|max:190',
            'en.title'          => 'required|min:3|max:190',
            'ar.feature_1'      => 'nullable|min:3|max:190',
            'en.feature_1'      => 'nullable|min:3|max:190',
            'ar.feature_2'      => 'nullable|min:3|max:190',
            'en.feature_2'      => 'nullable|min:3|max:190',
            'ar.feature_3'      => 'nullable|min:3|max:190',
            'en.feature_3'      => 'nullable|min:3|max:190',
            'ar.feature_4'      => 'nullable|min:3|max:190',
            'en.feature_4'      => 'nullable|min:3|max:190',
            'type_id'           => 'nullable|exists:types,id',
            'units'             => 'required|numeric',
            'price'             => 'required|numeric',
        ];
    }
}
