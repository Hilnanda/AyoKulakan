<?php

namespace App\Http\Requests\FrontEnd\Cart;

use App\Http\Requests\Request;

class CartMidtransRequest extends Request
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
          "nama" => 'required',
          "negara" => 'required',
          "provinsi" => 'required',
          "kota" => 'required',
          "kecamatan" => 'required',
          "alamat" => 'required',
          "kode_pos" => 'required',
          "email" => 'required',
          "hp" => 'required',
        ];
    }
   
    public function messages()
    {
      return [
        'accept.barang.*' => 'Silahkan Pilih Salah Satu Barang Untuk Di Bayar',
      ];
    }
}
