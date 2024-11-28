<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable,HasApiTokens;
   

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'id_number', // Add id_number
        'mobile', // Add
        'gender', //
        'role',
        'school_id',
        'school_group_id',
        'student_id_number',
        'date_of_birth'

    ];

    public function school()
    {
        return $this->belongsTo(School::class);
    }
  
    public function schoolGroup()
    {
        return $this->belongsTo(SchoolGroup::class);
    }
  
    public function responsibleGroups()
    {
        return $this->hasMany(SchoolGroup::class, 'responsible_user_id');
    }
  
    // Helper methods
    public function isStudent()
    {
        return $this->role === 'student';
    }
  
    public function isTeacher()
    {
        return $this->role === 'teacher';
    }
  
    public function isAdmin()
    {
        return $this->role === 'admin';
    }



    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }
}
