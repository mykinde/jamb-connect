<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Course extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'category_id',
    ];

    /**
     * Get the category that owns the course.
     */
    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }

    /**
     * Get the corrections where this course is listed as course1.
     */
    public function correctionsAsCourse1(): HasMany
    {
        return $this->hasMany(Correction::class, 'course1_id');
    }

    /**
     * Get the corrections where this course is listed as course2.
     */
    public function correctionsAsCourse2(): HasMany
    {
        return $this->hasMany(Correction::class, 'course2_id');
    }

    /**
     * Get the corrections where this course is listed as course3.
     */
    public function correctionsAsCourse3(): HasMany
    {
        return $this->hasMany(Correction::class, 'course3_id');
    }

    /**
     * Get the corrections where this course is listed as course4.
     */
    public function correctionsAsCourse4(): HasMany
    {
        return $this->hasMany(Correction::class, 'course4_id');
    }
}