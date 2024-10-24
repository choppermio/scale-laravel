<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ThakaatResult extends Model
{
    protected $fillable = ['category', 'score', 'percentage','user_id','test_number'];
}
