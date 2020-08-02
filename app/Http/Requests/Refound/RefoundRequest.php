<?php

namespace App\Http\Requests\Refound;

use App\Http\Requests\Request;

class RefoundRequest extends Request
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'form_type' => 'required',
            'trans_id' => 'required',
			'lapak_id' => 'required',
            'form_id' => 'required',
        ];
    }
   
    public function attributes(){
        return [
            'form_type' => 'Kategori',
            'trans_id' => 'Order Id',
            'form_id' => 'Barang',
            'lapak_id' => 'Lapak'
        ];
    }

    public function messages()
    {
      return [
        'attachment.*.max' => 'Lampiran Tidak Boleh Lebih Dari 2 MB',
      ];
    }
}
