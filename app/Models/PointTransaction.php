<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PointTransaction extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'user_id',
        'points',
        'type',
        'description',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected function casts(): array
    {
        return [
            'points' => 'integer',
        ];
    }

    /**
     * Get the user that owns the point transaction.
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Scope to get earned points.
     */
    public function scopeEarned($query)
    {
        return $query->where('type', 'earn');
    }

    /**
     * Scope to get redeemed points.
     */
    public function scopeRedeemed($query)
    {
        return $query->where('type', 'redeem');
    }

    /**
     * Check if this is an earn transaction.
     */
    public function isEarn()
    {
        return $this->type === 'earn';
    }

    /**
     * Check if this is a redeem transaction.
     */
    public function isRedeem()
    {
        return $this->type === 'redeem';
    }
}
