<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class VerifiableFileResource extends JsonResource
{
    protected $issue_name;
    protected $result;

    public function __construct($issue_name, $result)
    {
        $this->issue_name = $issue_name;
        $this->result     = $result;
    }

    public function toArray(Request $request): array
    {
        return [
            "issuer" => $this->issue_name,
            "result" => $this->result
        ];
    }
}
