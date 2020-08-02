<?php

namespace App\Http\Requests\APIRequest;

use App\Http\Requests\Request;
 
use Illuminate\Http\JsonResponse;
use Illuminate\Validation\ValidationException;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;
class KurirRequest extends Request
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
          'fotoSim' => 'max:5120|image|mimes:jpg,png,jpeg',
          'fotoKtp'=>'max:5120|image|mimes:jpg,png,jpeg',
          'swafoto' => 'max:5120|image|mimes:jpg,png,jpeg',
          "fotocopyKK"=>"max:5120|image|mimes:jpg,png,jpeg",
          "email"=>'required|string|email|max:255|unique:trans_kurir,email',
        ];
    }
   
    public function messages()
    {
      return [
        'fotoSim.max' => 'Gambar tidak boleh lebih dari 5 MB',
          'fotoSim.mimes' => 'File Harus Berupa png, jpg, jpeg, gif',
          'fotoSim.dimensions' => 'Ukuran Kurang Gambar Harus 1070 X 490',

          'fotoKtp.max' => 'Gambar tidak boleh lebih dari 5 MB',
          'fotoKtp.mimes' => 'File Harus Berupa png, jpg, jpeg, gif',
          'fotoKtp.dimensions' => 'Ukuran Kurang Gambar Harus 1070 X 490',

          'swafoto.max' => 'Gambar tidak boleh lebih dari 5 MB',
          'swafoto.mimes' => 'File Harus Berupa png, jpg, jpeg, gif',
          'swafoto.dimensions' => 'Ukuran Kurang Gambar Harus 1070 X 490',

          'fotocopyKK.max' => 'Gambar tidak boleh lebih dari 5 MB',
          'fotocopyKK.mimes' => 'File Harus Berupa png, jpg, jpeg, gif',
          'fotocopyKK.dimensions' => 'Ukuran Kurang Gambar Harus 1070 X 490',
      ];
    }

    protected function failedValidation(Validator $validator)
    {
        $errors = (new ValidationException($validator))->errors();
        throw new HttpResponseException(response()->json(['errors' => $errors
        ], JsonResponse::HTTP_UNPROCESSABLE_ENTITY));
    }

}
