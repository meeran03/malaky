<?php

namespace App\Http\Requests;

use Carbon\Carbon;
use Illuminate\Foundation\Http\FormRequest;

class CouponRequest extends FormRequest
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
            'title'          => 'required|min:5|max:10',
            'units'          => 'required|numeric',
            'from'           => 'required|date|before:to|after_or_equal:today',
            'to'             => 'required|date|after:from',
        ];
    }
}
