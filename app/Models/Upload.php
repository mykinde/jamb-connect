<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Upload extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'user_id',
        'exam_number',
        'exam_year',
        'subject_id',
        'exam_series',
        'exam_type',
        'grade',
        'image_path',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'exam_year' => 'integer',
    ];

    /**
     * Get the user that owns the upload.
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Get the subject associated with the upload.
     */
    public function subject(): BelongsTo
    {
        return $this->belongsTo(Subject::class);
    }
}