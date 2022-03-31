<?php

namespace App\Http\Request;

use Illuminate\Foundation\Http\FormRequest;

class SubmitFormRequest extends FormRequest
{
    public function rules()
    {
        return [
            'email' => 'required|email',
            'symbol' => 'required|string|min:1|max:5',
            'dateStart' => 'required|date',
            'dateEnd' => 'required|date',
        ];
    }
}
