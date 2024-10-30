<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class HollandTestResult extends Model
{
    protected $fillable = ['user_id', 'question_number', 'question_text', 'category', 'answer','test_number'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}