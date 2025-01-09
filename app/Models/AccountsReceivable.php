<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class AccountsReceivable extends Model
{
    use HasFactory;
    protected $table = 'accounts_receivable';
    protected $fillable = ['amount', 'customer_id', 'invoice_doc', 'status', 'due_date'];

    public function customer(): BelongsTo
    {
        return $this->belongsTo(Customer::class);
    }

    public function accountsReceivablePayment(): HasMany
    {
        return $this->hasMany(AccountsReceivablePayment::class, 'accounts_receivable_id');
    }
}
