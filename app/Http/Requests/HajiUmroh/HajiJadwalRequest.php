<?php

namespace App\Http\Requests\HajiUmroh;

use App\Http\Requests\Request;

class HajiJadwalRequest extends Request
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
          'paket_id' => 'required',
          'judul' => 'required',
          'tgl_berangkat' => 'required',
          'tgl_pulang' => 'required',
          'total_hari' => 'required',
          'keterangan' => 'required',
          'harga' => 'required',
        ];
    }
}
