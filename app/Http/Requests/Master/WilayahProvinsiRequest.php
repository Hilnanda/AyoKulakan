<?php

namespace App\Http\Requests\Master;

use App\Http\Requests\Request;

class WilayahProvinsiRequest extends Request
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
          'provinsi' => 'required|unique:ref_wilayah_provinsi,provinsi,'.$this->get('id'),
        ];
    }
   
    public function messages()
    {
      return [
        'attachment.*.max' => 'Lampiran Tidak Boleh Lebih Dari 2 MB',
      ];
    }
}
