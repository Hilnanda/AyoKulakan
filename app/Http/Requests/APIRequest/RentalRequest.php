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
          'judul' => 'required|unique:trans_rental,judul',
          'keterangan' => 'required|max:450',
          'kategori_id' => 'required',
          // 'sub_kategori_id', => 'required',
          'unit' => 'required|numeric|min:1',
          'harga_sewa' => 'required',
          'attachment.*'=>'max:5120|image|mimes:jpg,png,jpeg',

        ];
    }
   
    public function messages()
    {
      return [
        'attachment.*.max' => 'Lampiran Tidak Boleh Lebih Dari 2 MB',
      ];
    }
}
