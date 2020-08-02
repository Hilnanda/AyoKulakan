<?php

namespace App\Http\Requests\Master;

use App\Http\Requests\Request;

class AirportRequest extends Request
{
  /**
   * Get the validation rules that apply to the request.
   *
   * @return array
   */
  public function rules()
  {
    return [
      'airport_name' => 'required|max:185',
      'airport_code' => 'required|max:185',
      'location_name' => 'required|max:185',
      'country_id' => 'required|max:185',
      'country_name' => 'required|max:185'
    ];
  }

  public function messages()
  {
    return [
      'attachment.*.max' => 'Lampiran Tidak Boleh Lebih Dari 2 MB',
    ];
  }
}
