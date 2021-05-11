<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SettingRequest extends FormRequest
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
            'ar.title'          => 'required|min:2|max:255',
            'en.title'          => 'required|min:2|max:255',
            'ar.description'    => 'nullable|min:2|max:255',
            'en.description'    => 'nullable|min:2|max:255',
            'logo'              => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:20048',
            'copyrights'        => 'nullable|min:2|max:255',
            'currency'          => 'nullable|min:2|max:255',
            'currency_dollar'   => 'nullable|numeric',
            'address'           => 'nullable|min:2|max:255',
            'phone'             => 'nullable|numeric',
            'phone2'            => 'nullable',
            'whatsapp'          => 'nullable',
            'email'             => 'required|email',
            'map'               => 'nullable|min:2|max:255',
            'facebook'          => 'nullable',
            'twitter'           => 'nullable',
            'linkedin'          => 'nullable',
            'youtube'           => 'nullable',
            'snapchat'          => 'nullable',
            'instagram'         => 'nullable',
            'maintenance'       => 'nullable',
        ];
    }
}
