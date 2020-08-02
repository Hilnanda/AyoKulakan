<?php

namespace App\Http\Requests\APIRequest;

use App\Http\Requests\Request;
 
use Illuminate\Http\JsonResponse;
use Illuminate\Validation\ValidationException;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;
class BarangRequest extends Request
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
      if(request()->route('id')){
        // if(isset(request()->attachment)){
          // if(!is_string(request()->attachment[0])){
          //   dd('asd');
          //   return [
          //     'id_kategori' => 'required',
          //     'nama_barang' => 'required|unique:trans_lapak_barang,nama_barang,'.request()->route('id'),
          //     'deskripsi_barang' => 'required',
          //     'satuan_barang' => 'required',
          //     'berat_barang' => 'required|min:0.1',
          //     'stock_barang' => 'required|min:1',
          //     'kondisi_barang' => 'required',
          //     'attachment.*'=>'max:5120|image|mimes:jpg,png,jpeg',
          //   ];
          // }
          
        // }else{
          return [
            'id_kategori' => 'required',
            'nama_barang' => 'required|unique:trans_lapak_barang,nama_barang,'.request()->route('id'),
            'deskripsi_barang' => 'required',
            'satuan_barang' => 'required',
            'berat_barang' => 'required|min:0.1',
            'stock_barang' => 'required|min:1',
            'kondisi_barang' => 'required',
          ];
        // }

      }else{
        return [
          'id_kategori' => 'required',
          'nama_barang' => 'required|unique:trans_lapak_barang,nama_barang',
          'deskripsi_barang' => 'required',
          'satuan_barang' => 'required',
          'berat_barang' => 'required|min:0.1',
          'stock_barang' => 'required|min:1',
          'kondisi_barang' => 'required',
          'attachment.*'=>'max:5120|image|mimes:jpg,png,jpeg',
        ];
      }
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
