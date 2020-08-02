<?php

namespace App\Http\Requests\HajiUmroh;

use App\Http\Requests\Request;

class HajiAngsuranRequest extends Request
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
          'id_paket' => 'required',
          'id_jadwal' => 'required',
          'nama' => 'required|max:150',
          'umur' => 'required',
        ];
    }
}
