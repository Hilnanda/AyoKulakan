<?php

namespace App\Models\Traits;


use Carbon\Carbon;

///trait ModelUtilitiesTrait

trait Utilities

{
    public function lpad($field, $length = 2, $padder = ' ')
    {
        return str_pad($this->$field, $length, $padder, STR_PAD_LEFT);
    }

    public function readMoreRaw($value, $maxLength = 150)
    {
        $return = $value;
        if (strlen($value) > $maxLength) {
            $return   = substr($value, 0, $maxLength);
            $readmore = substr($value, $maxLength);

            $return .= '<a href="javascript: void(0)" class="read-more" onclick="$(this).parent().find(\'.read-more-cage\').show(); $(this).hide()">&nbsp;&nbsp;read more</a>';

            $readless = '<a href="javascript: void(0)" class="read-less" onclick="$(this).parent().parent().find(\'.read-more\').show(); $(this).parent().hide()">&nbsp;&nbsp;read less</a>';

            $return = "<span>{$return}<span style='display: none' class='read-more-cage'>{$readmore} {$readless}</span></span>";
        }

        return $return;
    }

    public function readMoreText($field, $maxLength = 150)
    {
        $value = $this->$field;
        return utf8_decode($this->readMoreRaw($value, $maxLength));
    }

    public static function options($display, $id = 'id', $params = [], $default=null)
    {
        $q = static::select('*');

        $params = array_merge([
            'valuePrefix' => '',
        ], $params);

        if (isset($params['filters'])) {
            // dd($params['filters']);
            foreach ($params['filters'] as $key => $value) {
                if (is_numeric($key) && is_callable($value)) {
                    // dd('cek');
                    $q = $q->where($value);
                } else {
                    if(is_array($value)){
                        $q = $q->whereIn($key, $value);
                    }else{
                        $q = $q->where($key, $value);
                    }
                }
            }
        }

        if (isset($params['not-null'])) {
            foreach ($params['not-null'] as $key => $value) {
                if (is_numeric($key)) {
                    $q = $q->whereNotNull($value);
                }
            }
        }

        if (isset($params['not-empty'])) {
            foreach ($params['not-empty'] as $key => $value) {
                if (is_numeric($key)) {
                    $q = $q->where($value, '!=', '');
                }
            }
        }

        if (isset($params['orders'])) {
            foreach ($params['orders'] as $key => $value) {
                if (is_numeric($key)) {
                    $key   = $value;
                    $value = 'asc';
                }

                $q = $q->orderBy($key, $value);
            }
        }

        $r = [];

        $ret = '';
        if ($default !== false) {
            if($default === null){
                $default = '(Pilih Salah Satu)';
            }
            $ret = '<option value="">' . $default . '</option>';
        }

        if (is_string($display)) {
            $q = $q->orderBy($display, 'asc');
            $r = $q->pluck($display, $id);

            foreach ($r as $i => $v) {
                $i = $params['valuePrefix'] . $i;
                if (isset($params['selected']) && $i == $params['selected']) {
                    $ret .= '<option value="' . $i . '" selected>' . $v . '</option>';
                } else {
                    $ret .= '<option value="' . $i . '">' . $v . '</option>';
                }
            }
        } elseif (is_callable($display)) {
            $r = $q->get();

            foreach ($r as $d) {
                $i = $params['valuePrefix'] . $d->$id;
                if (isset($params['selected']) && $d->$id == $params['selected']) {
                    $ret .= '<option value="' . $i . '" selected>' . $display($d) . '</option>';
                } else {
                    $ret .= '<option value="' . $i . '">' . $display($d) . '</option>';
                }
            }
        }
        return $ret;
    }


}
