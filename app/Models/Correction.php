<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Correction extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'user_id',          // The ID of the user who submitted the correction
        'institution1_id',
        'course1_id',
        'institution2_id',
        'course2_id',
        'institution3_id',
        'course3_id',
        'institution4_id',
        'course4_id',
        // Add any other fields related to the correction itself, e.g., 'notes', 'status'
        // 'notes',
        // 'status', // e.g., 'pending', 'reviewed', 'applied', 'rejected'
    ];

    /**
     * Get the user that submitted the correction.
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Get the first institution related to the correction.
     */
    public function institution1(): BelongsTo
    {
        return $this->belongsTo(Institution::class, 'institution1_id');
    }

    /**
     * Get the first course related to the correction.
     */
    public function course1(): BelongsTo
    {
        return $this->belongsTo(Course::class, 'course1_id');
    }

    /**
     * Get the second institution related to the correction.
     */
    public function institution2(): BelongsTo
    {
        return $this->belongsTo(Institution::class, 'institution2_id');
    }

    /**
     * Get the second course related to the correction.
     */
    public function course2(): BelongsTo
    {
        return $this->belongsTo(Course::class, 'course2_id');
    }

    /**
     * Get the third institution related to the correction.
     */
    public function institution3(): BelongsTo
    {
        return $this->belongsTo(Institution::class, 'institution3_id');
    }

    /**
     * Get the third course related to the correction.
     */
    public function course3(): BelongsTo
    {
        return $this->belongsTo(Course::class, 'course3_id');
    }

    /**
     * Get the fourth institution related to the correction.
     */
    public function institution4(): BelongsTo
    {
        return $this->belongsTo(Institution::class, 'institution4_id');
    }

    /**
     * Get the fourth course related to the correction.
     */
    public function course4(): BelongsTo
    {
        return $this->belongsTo(Course::class, 'course4_id');
    }
}