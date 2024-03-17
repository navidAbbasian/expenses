<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Bank extends Model
{
    use HasFactory;

    public function user(): BelongsTo
    {
        return $this->belongsTo(related: User::class, foreignKey: 'account_owner', ownerKey: 'id');
    }

    public function fromTransactions(): HasMany
    {
        return $this->hasMany(related: Transaction::class, foreignKey: 'from', localKey: 'id');
    }

    public function toTransactions(): HasMany
    {
        return $this->hasMany(related: Transaction::class, foreignKey: 'to', localKey: 'id');
    }

}
