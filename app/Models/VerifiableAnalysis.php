<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class VerifiableAnalysis extends Model
{
    use HasFactory;

    protected $table='verifiable_analysis'; 

    protected $guarded = [
        'created_at', 'updated_at'
    ];

    protected $fillable = [
        'file_id','user_id', 'file_type', 'result'
    ];
}
