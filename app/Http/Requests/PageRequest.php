<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PageRequest extends FormRequest
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
            'image'             => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:20048',
            'ar.title'          => 'required|min:2|max:190',
            'en.title'          => 'required|min:2|max:190',
            'ar.excerpt'        => 'nullable|min:2|max:255',
            'en.excerpt'        => 'nullable|min:2|max:255',
            'ar.content'        => 'nullable|min:2',
            'en.content'        => 'nullable|min:2',
        ];
    }
}
