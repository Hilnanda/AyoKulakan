<?php

namespace App\Http\Requests\Master;

use App\Http\Requests\Request;

class AplikasiPanduanRequest extends Request
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
          'deskripsi' => 'required',
          'kategori' => 'required|unique:ref_aplikasi_panduan,kategori,'.$this->get('id'),
        ];
    }
   
    public function messages()
    {
      return [
        'attachment.*.max' => 'Lampiran Tidak Boleh Lebih Dari 2 MB',
      ];
    }
}
