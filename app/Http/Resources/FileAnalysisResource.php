<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class FileAnalysisResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            "id"        => $this->id,
            "file_id"   => $this->file_id,
            "user_name" => $this->user->name,
            "verification_result" => $this->verification_result,
            "created_at" => $this->created_at->format("Y-m-d H:m:s"),
            "updated_at" => $this->created_at->format("Y-m-d H:m:s"),
        ];
    }
}
