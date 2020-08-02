<?php

namespace App\Http\Requests\Profile;

use App\Http\Requests\Request;

class ProfileRequest extends Request
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
          'nama' => 'required|string|max:255',
          'gender' => 'required',
          'kode_pos' => 'required',
          'hp' => 'required',
          'id_provinsi' => 'required',
          'id_kota' => 'required',
          'id_kecamatan' => 'required',
          'alamat' => 'required',

          'username' => 'string|max:255|unique:sys_users,username,'.$this->get('id'),
          'email' => 'string|email|max:255|unique:sys_users,email,'.$this->get('id'),
         

        ];

    }
   
    public function messages()
    {
      return [
        'attachment.*.max' => 'Lampiran Tidak Boleh Lebih Dari 2 MB',
      ];
    }
}
