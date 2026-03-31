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
        'usage_count',
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
            'usage_count' => 'integer',
            'usage_limit' => 'integer',
        ];
    }

    /**
     * Check if coupon is valid.
     */
    public function isValid()
    {
        // Check expiration
        if ($this->expires_at && $this->expires_at->isPast()) {
            return false;
        }

        // Check usage limit
        if ($this->usage_limit && $this->usage_count >= $this->usage_limit) {
            return false;
        }

        return true;
    }

    /**
     * Get the orders that use this coupon.
     */
    public function orders()
    {
        return $this->hasMany(Order::class);
    }

    /**
     * Increment usage count.
     */
    public function incrementUsage()
    {
        $this->increment('usage_count');
    }

    /**
     * Get usage count for a specific customer.
     */
    public function getCustomerUsageCount($userId)
    {
        return $this->orders()->where('user_id', $userId)->count();
    }

    /**
     * Check if coupon is still valid (not expired, has usage left).
     */
    public function isAvailableForCustomer($userId)
    {
        // Check if coupon is valid (not expired, global usage limit not reached)
        if (!$this->isValid()) {
            return false;
        }

        // Check if customer-specific usage limit exists and is not exceeded
        // Note: usage_limit is global, but we track per-customer usage
        $customerUsage = $this->getCustomerUsageCount($userId);

        // For now, we allow customers to use the coupon as long as it's globally valid
        // You can add per-customer limit logic here if needed
        return true;
    }

    /**
     * Get remaining uses for a customer (based on global limit minus customer's usage).
     */
    public function getRemainingUsesForCustomer($userId)
    {
        $customerUsage = $this->getCustomerUsageCount($userId);

        if (!$this->usage_limit) {
            return null; // Unlimited
        }

        $remaining = $this->usage_limit - $this->usage_count;
        return max(0, $remaining);
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
