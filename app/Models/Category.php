<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Category extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
    ];

    /**
     * Get the institutions associated with the category.
     */
    public function institutions(): HasMany
    {
        return $this->hasMany(Institution::class);
    }

    /**
     * Get the courses associated with the category.
     */
    public function courses(): HasMany
    {
        return $this->hasMany(Course::class);
    }
}