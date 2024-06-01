<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Tag extends Model
{
    use HasFactory;

    protected $guarded = [];

    protected $appends = ['TagsTransactionBalance'];

    public function transactions(): BelongsToMany
    {
        return $this->belongsToMany(related: Transaction::class,
            table: 'tags_transactions',
            foreignPivotKey: 'tag_id',
            relatedPivotKey: 'transaction_id');
    }

    public function getTagsTransactionBalanceAttribute()
    {
        return $this->transactions()->where('type', 'income')->sum('amount') -
            $this->transactions()->where('type', 'cost')->sum('amount');
    }
}
