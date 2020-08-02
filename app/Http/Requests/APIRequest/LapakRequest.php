<?php

namespace App\Http\Requests\APIRequest;

use App\Http\Requests\Request;
 
use Illuminate\Http\JsonResponse;
use Illuminate\Validation\ValidationException;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;
class LapakRequest extends Request
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */

    public function authorize()
    {
         return true;   //Default false .Now set return true;
    }

    public function rules()
    {
        return [
          'nama_lapak' => 'required',
          'deskripsi_lapak' => 'required',
          'id_negara' => 'required',
          'id_provinsi' => 'required',
          'id_kota' => 'required',
          'id_kecamatan' => 'required',
          'phone' => 'required',
          'kode_pos' => 'required',
          'alamat_lapak' => 'required',
          "attachment.*"=>"max:5120|image|mimes:jpg,png,jpeg",
        ];
    }
   
    public function messages()
    {
      return [
        'attachment.*.max' => 'Lampiran Tidak Boleh Lebih Dari 2 MB',
      ];
    }

    protected function failedValidation(Validator $validator)
    {
        $errors = (new ValidationException($validator))->errors();
        throw new HttpResponseException(response()->json(['errors' => $errors
        ], JsonResponse::HTTP_UNPROCESSABLE_ENTITY));
    }
}
