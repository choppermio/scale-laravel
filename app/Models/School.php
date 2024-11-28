<?php
// app/Models/School.php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class School extends Model
{
  use HasFactory;

  /**
   * The attributes that are mass assignable.
   *
   * @var array<int, string>
   */
  protected $fillable = [
      'name',
      'address',
      'phone',
  ];

  /**
   * Get all groups belonging to the school
   */
  public function groups(): HasMany
  {
      return $this->hasMany(SchoolGroup::class);
  }

  /**
   * Get all students in the school
   */
  public function students(): HasMany
  {
      return $this->hasMany(User::class)->where('role', 'student');
  }

  /**
   * Get all teachers in the school
   */
  public function teachers(): HasMany
  {
      return $this->hasMany(User::class)->where('role', 'teacher');
  }

  /**
   * Get the total number of students
   */
  public function getStudentsCountAttribute(): int
  {
      return $this->students()->count();
  }

  /**
   * Get the total number of groups
   */
  public function getGroupsCountAttribute(): int
  {
      return $this->groups()->count();
  }

  /**
   * Scope a query to include student counts
   */
  public function scopeWithStudentCounts($query)
  {
      return $query->withCount(['students']);
  }

  /**
   * Scope a query to include group counts
   */
  public function scopeWithGroupCounts($query)
  {
      return $query->withCount(['groups']);
  }
}