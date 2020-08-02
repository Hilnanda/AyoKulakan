<?php

namespace App\Http\Requests\Master;

use App\Http\Requests\Request;

class PPOBPulsaRequest extends Request
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
         	'pulsa_code' => 'required',
			'pulsa_op' => 'required',
			'pulsa_nominal' => 'required',
			'pulsa_price' => 'required',
			'pulsa_type' => 'required',
			// 'status' => 'required',
			'masaaktif' => 'required',
        ];
    }
   
    public function messages()
    {
      return [
        'attachment.*.max' => 'Lampiran Tidak Boleh Lebih Dari 2 MB',
      ];
    }
}
