<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ResultsStore extends Model
{
    use HasFactory;

    // Define the table associated with the model
    protected $table = 'resultsstore';

    // Specify the attributes that are mass assignable
    protected $fillable = ['user_id', 'results'];

    // If your table uses timestamps, ensure they're enabled
    public $timestamps = true;
}
