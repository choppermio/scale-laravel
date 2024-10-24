<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ThakaatAnswer extends Model
{
    //
    protected $fillable = ['user_id', 'question_id', 'answer','test_number'];
}
