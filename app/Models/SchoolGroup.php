<?php
// app/Models/SchoolGroup.php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class SchoolGroup extends Model
{
  use HasFactory;
  protected $table = 'school_groups';

  /**
   * The attributes that are mass assignable.
   *
   * @var array<int, string>
   */
  protected $fillable = [
      'name',
      'school_id',
      'responsible_user_id',
  ];

  /**
   * Get the school that owns the group
   */
  public function school(): BelongsTo
  {
      return $this->belongsTo(School::class);
  }

public function schools()
{
 $this->hasMany(School::class);
}
  /**
   * Get the responsible teacher/user for the group
   */
  public function responsible(): BelongsTo
  {
      return $this->belongsTo(User::class, 'responsible_user_id');
  }

  public function responsibleUser(): BelongsTo
  {
      return $this->belongsTo(User::class, 'responsible_user_id');
  }
  /**
   * Get all students in the group
   */
  public function students(): HasMany
  {
      return $this->hasMany(User::class, 'school_group_id')->where('role', 'student');
  }

  /**
   * Get the total number of students
   */
  public function getStudentsCountAttribute(): int
  {
      return $this->students()->count();
  }

  /**
   * Add a student to the group
   */
  public function addStudent(User $user): bool
  {
      if ($user->role !== 'student') {
          return false;
      }

      $user->update([
          'school_group_id' => $this->id,
          'school_id' => $this->school_id
      ]);

      return true;
  }

  /**
   * Remove a student from the group
   */
  public function removeStudent(User $user): bool
  {
      if ($user->school_group_id !== $this->id) {
          return false;
      }

      $user->update([
          'school_group_id' => null
      ]);

      return true;
  }

  /**
   * Change the responsible person for the group
   */
  public function changeResponsible(User $user): bool
  {
      if ($user->role === 'student') {
          return false;
      }

      $this->responsible_user_id = $user->id;
      return $this->save();
  }

  /**
   * Scope a query to include student counts
   */
  public function scopeWithStudentCounts($query)
  {
      return $query->withCount(['students']);
  }

  /**
   * Scope a query to include responsible user
   */
  public function scopeWithResponsible($query)
  {
      return $query->with(['responsible']);
  }

  /**
   * Check if the group has available capacity
   */
  public function hasCapacity(int $maxCapacity = 30): bool
  {
      return $this->students()->count() < $maxCapacity;
  }
}