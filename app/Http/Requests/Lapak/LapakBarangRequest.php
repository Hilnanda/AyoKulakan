<?php

namespace App\Http\Requests\Lapak;

use App\Http\Requests\Request;

class LapakBarangRequest extends Request
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
          'id_kategori' => 'required',
          'nama_barang' => 'required|unique:trans_lapak_barang,nama_barang,'.$this->get('id'),
          'deskripsi_barang' => 'required',
          'satuan_barang' => 'required',
          'berat_barang' => 'required|min:0.1',
          'stock_barang' => 'required|min:1',
          'kondisi_barang' => 'required',
          // 'harga_barang' => 'required|min:1',
        ];
    }
   
    public function messages()
    {
      return [
        'attachment.*.max' => 'Lampiran Tidak Boleh Lebih Dari 2 MB',
      ];
    }
}
