<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Coupon extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'code',
        'type',
        'value',
        'max_discount',
        'expires_at',
        'usage_limit',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected function casts(): array
    {
        return [
            'value' => 'decimal:2',
            'max_discount' => 'decimal:2',
            'expires_at' => 'datetime',
        ];
    }

    /**
     * Check if coupon is valid.
     */
    public function isValid()
    {
        if ($this->expires_at && $this->expires_at->isPast()) {
            return false;
        }

        return true;
    }

    /**
     * Check if coupon is percentage type.
     */
    public function isPercentage()
    {
        return $this->type === 'percent';
    }

    /**
     * Calculate discount for a given amount.
     */
    public function calculateDiscount($amount)
    {
        if ($this->isPercentage()) {
            $discount = ($amount * $this->value) / 100;
            if ($this->max_discount) {
                $discount = min($discount, $this->max_discount);
            }
            return $discount;
        }

        return min($this->value, $amount);
    }
}
