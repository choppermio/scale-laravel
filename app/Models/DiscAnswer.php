<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DiscAnswer extends Model
{
    protected $fillable = ['user_id', 'question_number', 'question_text','test_number','value_checked'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}  
