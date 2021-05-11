<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CityUpdateRequest extends FormRequest
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
            'country_id' => 'required|exists:countries,id',
            'title_ar' => 'required|min:2|max:255|unique:cities,title_ar,'.$this->city->id,
            'title_en' => 'required|min:2|max:255|unique:cities,title_en,'.$this->city->id,
        ];
    }
}
