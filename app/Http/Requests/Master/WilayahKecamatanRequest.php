<?php

namespace App\Http\Requests\Master;

use App\Http\Requests\Request;

class WilayahKecamatanRequest extends Request
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
          'id_negara' => 'required',
          'id_provinsi' => 'required',
          'id_kota' => 'required',
          'kecamatan' => 'required|unique:ref_wilayah_kecamatan,kecamatan,'.$this->get('id'),
        ];
    }
   
    public function messages()
    {
      return [
        'attachment.*.max' => 'Lampiran Tidak Boleh Lebih Dari 2 MB',
      ];
    }
}
