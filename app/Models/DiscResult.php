<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use HasFactory;

class DiscResult extends Model
{

    protected $table = 'disc_results'; // Specify the table name

    // Define the fillable properties
    protected $fillable = [
        'user_id',
        'test_number',
        'results',
        'test_number'
    ];

    // Define the relationship with the User model (if applicable)
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
