<?php

namespace App\Http\Requests\Rental;

use App\Http\Requests\Request;

class RentalRequest extends Request
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
          'judul' => 'required',
          'keterangan' => 'required',
          'kategori_id' => 'required',
          'sub_kategori_id' => 'required',
          'unit' => 'required',
          'harga_sewa' => 'required',
        ];
    }
   
    public function messages()
    {
      return [
        'attachment.*.max' => 'Lampiran Tidak Boleh Lebih Dari 2 MB',
      ];
    }
}
