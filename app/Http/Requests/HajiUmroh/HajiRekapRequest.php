<?php

namespace App\Http\Requests\HajiUmroh;

use App\Http\Requests\Request;

class HajiRekapRequest extends Request
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
          'user_id' => 'required',
          'tgl_pembayaran' => 'required',
          'uang_pembayaran' => 'required',
          'status' => 'required',
        ];
    }
}
