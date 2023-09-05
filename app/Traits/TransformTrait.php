<?php

namespace App\Traits;

use Illuminate\Http\Request;

trait TransformTrait
{

    public function flattenArrayKeys($array, $prefix = '')
    {
        $result = array();
        foreach ($array as $key => $value) {
            if (is_array($value)) {
                $result = array_merge($result, $this->flattenArrayKeys($value, $prefix . $key . '.'));
            } else {
                $result[$prefix . $key] = $value;
            }
        }
        return $result;
    }
}
