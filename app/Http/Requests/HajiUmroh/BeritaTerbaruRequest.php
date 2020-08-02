<?php

namespace App\Http\Requests\HajiUmroh;

use App\Http\Requests\Request;

class BeritaTerbaruRequest extends Request
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
          'deskripsi' => 'required'
        ];
    }
   
    public function messages()
    {
      return [
        'attachment.*.max' => 'Lampiran Tidak Boleh Lebih Dari 2 MB',
      ];
    }
}
