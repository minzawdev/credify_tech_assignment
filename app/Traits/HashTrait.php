<?php

namespace App\Traits;

use Illuminate\Http\Request;

trait HashTrait
{
    public function compute_property_hash($key, $value)
    {
        $data = array($key => $value);
        $data_str = json_encode($data, JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE);
        return hash('sha256', $data_str);
    }

    public function hashTransformData($transformData)
    {
        $hashes = [];

        foreach ($transformData as $key => $value) {
            $hash = $this->compute_property_hash($key, $value);
            $hashes[] = $hash;
        }
        sort($hashes);

        $combined_hash_input = implode('', $hashes);

        $hashed_data = hash('sha256', $combined_hash_input);

        return $hashed_data;
    }
}
