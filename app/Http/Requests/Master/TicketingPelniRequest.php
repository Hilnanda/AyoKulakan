<?php

namespace App\Http\Requests\Master;

use App\Http\Requests\Request;

class TicketingPelniRequest extends Request
{
  /**
   * Get the validation rules that apply to the request.
   *
   * @return array
   */
  public function rules()
  {
    return [
      'name' => 'required|max:185',
      'code' => 'required|max:185'
    ];
  }

  public function messages()
  {
    return [
      'attachment.*.max' => 'Lampiran Tidak Boleh Lebih Dari 2 MB',
    ];
  }
}
