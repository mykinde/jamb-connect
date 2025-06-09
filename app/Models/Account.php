<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Account extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'user_id',
        'profile_code',
        'application_type',
        'phone',
        'email_address',
        'last_jamb_year',
        'last_institution_attended',
        'proposed_new_institution',
        'proposed_course',
        'application_year',
        'nationality',
        'state',
        'lga',
        'blind',
        'deaf',
        'dumb',
        'lame',
        'marital_status',
        'resident_address',
        'resident_town',
        'resident_state',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'last_jamb_year' => 'integer',
        'application_year' => 'integer',
        'blind' => 'boolean',
        'deaf' => 'boolean',
        'dumb' => 'boolean',
        'lame' => 'boolean',
    ];

    /**
     * Get the user that owns the account.
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    
}