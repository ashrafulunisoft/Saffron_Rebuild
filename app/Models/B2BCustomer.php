<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class B2BCustomer extends Model
{
    use HasFactory, SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'user_id',
        'company_name',
        'trade_license_number',
        'tax_id',
        'business_type',
        'contact_person',
        'contact_phone',
        'contact_email',
        'billing_address',
        'shipping_address',
        'credit_limit',
        'current_balance',
        'payment_terms',
        'payment_days',
        'pricing_tier',
        'wholesale_discount',
        'approval_status',
        'rejection_reason',
        'approved_at',
        'approved_by',
        'notes',
        'is_active',
    ];

    /**
     * The attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'credit_limit' => 'decimal:2',
            'current_balance' => 'decimal:2',
            'wholesale_discount' => 'decimal:2',
            'approved_at' => 'datetime',
            'is_active' => 'boolean',
        ];
    }

    /**
     * Get the user that owns the B2B customer.
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Get the admin who approved the B2B customer.
     */
    public function approver()
    {
        return $this->belongsTo(User::class, 'approved_by');
    }

    /**
     * Get the orders for the B2B customer.
     */
    public function orders()
    {
        return $this->hasMany(Order::class, 'b2b_customer_id');
    }

    /**
     * Scope to filter pending approvals.
     */
    public function scopePending($query)
    {
        return $query->where('approval_status', 'pending');
    }

    /**
     * Scope to filter approved customers.
     */
    public function scopeApproved($query)
    {
        return $query->where('approval_status', 'approved');
    }

    /**
     * Scope to filter rejected customers.
     */
    public function scopeRejected($query)
    {
        return $query->where('approval_status', 'rejected');
    }

    /**
     * Scope to filter active customers.
     */
    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }

    /**
     * Check if B2B customer is approved.
     */
    public function isApproved(): bool
    {
        return $this->approval_status === 'approved';
    }

    /**
     * Check if B2B customer is pending approval.
     */
    public function isPending(): bool
    {
        return $this->approval_status === 'pending';
    }

    /**
     * Get available credit.
     */
    public function getAvailableCreditAttribute(): float
    {
        return $this->credit_limit - $this->current_balance;
    }

    /**
     * Get total orders count.
     */
    public function getTotalOrdersAttribute(): int
    {
        return $this->orders()->count();
    }

    /**
     * Get total purchase amount.
     */
    public function getTotalPurchaseAttribute(): float
    {
        return $this->orders()->where('status', '!=', 'cancelled')->sum('final_amount');
    }
}
