<?php

namespace App\Http\Requests\UserManagement;

use App\Http\Requests\Request;

class RoleRequest extends Request
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
          'display_name' => 'required|unique:sys_roles,display_name,'.$this->get('id'),
        ];
    }

    public function attributes()
    {
       return [
         'display_name' => 'Role Name',
       ];
    }
}
