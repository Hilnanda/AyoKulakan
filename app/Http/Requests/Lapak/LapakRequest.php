<?php

namespace App\Http\Requests\Lapak;

use App\Http\Requests\Request;

class LapakRequest extends Request
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
          'nama_lapak' => 'required',
          'deskripsi_lapak' => 'required',
          'id_negara' => 'required',
          'id_provinsi' => 'required',
          'id_kota' => 'required',
          'id_kecamatan' => 'required',
          'phone' => 'required',
          'kode_pos' => 'required',
          'alamat_lapak' => 'required',
        ];
    }
   
    public function messages()
    {
      return [
        'attachment.*.max' => 'Lampiran Tidak Boleh Lebih Dari 2 MB',
      ];
    }
}
