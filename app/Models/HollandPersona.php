<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class HollandPersona extends Model
{
    protected $fillable = [
        'user_id', 'first_type', 'first_score', 
        'second_type', 'second_score', 
        'third_type', 'third_score','created_at'
        
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}