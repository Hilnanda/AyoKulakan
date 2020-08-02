<?php

namespace App\Http\Requests\KakiLima;

use App\Http\Requests\Request;

class KakiLimaRequest extends Request
{
  /**
   * Get the validation rules that apply to the request.
   *
   * @return array
   */
  public function rules()
  {
    return [
      'name' => 'required|max:200',
      'type_usaha' => 'required|max:200',
      'keterangan' => 'required',
    ];
  }

  public function messages()
  {
    return [
      'nik.digits' => 'NIK Tidak Boleh Lebih Dari 16',
      'kendaraan.digits' => 'Kendaraan Tidak Boleh Lebih Dari 3',
      'sim.digits' => 'SIM Tidak Boleh Lebih Dari 7',
    ];
  }
}
