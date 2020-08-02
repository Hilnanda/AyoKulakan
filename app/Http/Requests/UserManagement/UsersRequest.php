<?php

namespace App\Http\Requests\UserManagement;

use App\Http\Requests\Request;

class UsersRequest extends Request
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
          'username' => 'required|string|max:255|unique:sys_users,username,'.$this->get('id'),
          'user_picture.*' => 'required',
          'email' => 'required|string|email|max:255|unique:sys_users,email,'.$this->get('id'),
        ];
    }
}
