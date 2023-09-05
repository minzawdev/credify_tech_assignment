<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Casts\Attribute;

class VerifiableAnalysis extends Model
{
    use HasFactory;

    protected $table='verifiable_analysis'; 

    protected $guarded = [
        'created_at', 'updated_at'
    ];

    protected $fillable = [
        'file_id','user_id', 'file_type', 'verification_result'
    ];

    public function user(){
        return $this->belongsTo(User::class);
    }

    protected function verificationResult():Attribute
    {
        return Attribute::make(
            get: fn ($value) => json_decode($value,true),
            set: fn ($value) => json_encode($value),
        );
    }
}
