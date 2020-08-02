<?php
namespace App\Models\Traits;

trait Generatable
{
    public function save(array $options = [])
    {
        $castToInt = isset($this->castToInt) ? $this->castToInt : true;
        $generable = isset($this->generable) ? $this->generable : 'code';
        if ($this->id) {
            return parent::save($options);
        }

        $old = null;
        $generated = 1;
        if ($castToInt) {
            $old = static::orderBy(\DB::raw('cast(' . $generable . ' AS UNSIGNED)'), 'desc')->first();
            if ($old) {
                $generated = intval($old[$generable]) + 1;
            }
        } else {
            $old = static::orderBy($generable, 'desc')->first();
            if ($old) {
                $generated = intval($old[$generable]) + 1;
            }
        }

        $this[$generable] = $generated;

        return parent::save($options);
    }
}
