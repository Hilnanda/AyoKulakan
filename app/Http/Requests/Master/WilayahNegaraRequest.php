<?php

namespace App\Http\Requests\Master;

use App\Http\Requests\Request;

class WilayahNegaraRequest extends Request
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
          'negara' => 'required|unique:ref_wilayah_negara,negara,'.$this->get('id'),
        ];
    }
   
    public function messages()
    {
      return [
        'attachment.*.max' => 'Lampiran Tidak Boleh Lebih Dari 2 MB',
      ];
    }
}
