<?php

namespace App\Http\Requests\Master;

use App\Http\Requests\Request;

class AplikasiSosialRequest extends Request
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
          'link' => 'required',
          'sosial_media' => 'required|unique:ref_aplikasi_sosial,sosial_media,'.$this->get('id'),
        ];
    }
   
    public function messages()
    {
      return [
        'attachment.*.max' => 'Lampiran Tidak Boleh Lebih Dari 2 MB',
      ];
    }
}
