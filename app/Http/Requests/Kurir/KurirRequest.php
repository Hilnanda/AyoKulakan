<?php

namespace App\Http\Requests\Kurir;

use App\Http\Requests\Request;

class KurirRequest extends Request
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
          'nik' => 'required|max:17',
          'kendaraan' => 'required|numeric|min:1|max:3',
          'sim' => 'required',
          'km' => 'required|numeric|min:1',
          'kg' => 'required|numeric|min:1',
        ];

    }
   
    public function messages()
    {
      return [
        'nik.max' => 'NIK Tidak Boleh Lebih Dari 16',
        'kendaraan.digits' => 'Kendaraan Tidak Boleh Lebih Dari 3',
        'sim.digits' => 'SIM Tidak Boleh Lebih Dari 7',
      ];
    }
}
