<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StatusRequest extends FormRequest
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
            'ar.title'          => 'required|min:2|max:190',
            'en.title'          => 'required|min:2|max:190',
        ];
    }
}
