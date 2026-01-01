<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class VerificationCode extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_id',
        'code',
        'expires_at'
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = [
        'expires_at' => 'datetime',
    ];

    /**
     * Get the user that owns the verification code.
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Check if the verification code is expired.
     *
     * @return bool
     */
    public function isExpired(): bool
    {
        return $this->expires_at->isPast();
    }

    /**
     * Scope a query to only include valid codes.
     *
     * @param  \Illuminate\Database\Eloquent\Builder  $query
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeValid($query)
    {
        return $query->where('expires_at', '>', now());
    }

    /**
     * Find a valid verification code for the given user and code.
     *
     * @param  int  $userId
     * @param  string  $code
     * @return VerificationCode|null
     */
    public static function findValid(int $userId, string $code): ?VerificationCode
    {
        return static::where('user_id', $userId)
            ->where('code', $code)
            ->valid()
            ->first();
    }
}