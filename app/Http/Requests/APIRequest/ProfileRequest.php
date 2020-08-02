<?php

namespace App\Http\Requests\APIRequest;

use App\Http\Requests\Request;
 
use Illuminate\Http\JsonResponse;
use Illuminate\Validation\ValidationException;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;
class ProfileRequest extends Request
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
          'foto_users.*'=>'max:5120|image|mimes:jpg,png,jpeg',
        ];
    }
   
    public function messages()
    {
      return [
        'foto_users.*.max' => 'Lampiran Tidak Boleh Lebih Dari 2 MB',
      ];
    }

    protected function failedValidation(Validator $validator)
    {
        $errors = (new ValidationException($validator))->errors();
        throw new HttpResponseException(response()->json(['errors' => $errors
        ], JsonResponse::HTTP_UNPROCESSABLE_ENTITY));
    }
}
