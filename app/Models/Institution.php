<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Institution extends Model
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
        'classification_id',
        'location',
    ];

    /**
     * Get the category that owns the institution.
     */
    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }

    /**
     * Get the classification that owns the institution.
     */
    public function classification(): BelongsTo
    {
        return $this->belongsTo(Classification::class);
    }

    /**
     * Get the corrections where this institution is listed as institution1.
     */
    public function correctionsAsInstitution1(): HasMany
    {
        return $this->hasMany(Correction::class, 'institution1_id');
    }

    /**
     * Get the corrections where this institution is listed as institution2.
     */
    public function correctionsAsInstitution2(): HasMany
    {
        return $this->hasMany(Correction::class, 'institution2_id');
    }

    /**
     * Get the corrections where this institution is listed as institution3.
     */
    public function correctionsAsInstitution3(): HasMany
    {
        return $this->hasMany(Correction::class, 'institution3_id');
    }

    /**
     * Get the corrections where this institution is listed as institution4.
     */
    public function correctionsAsInstitution4(): HasMany
    {
        return $this->hasMany(Correction::class, 'institution4_id');
    }
}