<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

abstract class Request extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return auth()->check() || !is_null($this->user());
    }

    /**
     * validation message that apply to the request.
     *
     * @return array
     */
    public function messages()
    {
        return [
            
        ];
    }
}
