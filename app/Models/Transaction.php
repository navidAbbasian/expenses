<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Transaction extends Model
{
    use HasFactory;

    protected $guarded = [];

    protected $with = ['tags'];

    public function tags(): BelongsToMany
    {
        return $this->belongsToMany(related: Tag::class, table: 'tags_transactions', foreignPivotKey: 'transaction_id', relatedPivotKey: 'tag_id');
    }

    public function fromBank(): BelongsTo
    {
        return $this->belongsTo(related: Bank::class, foreignKey: 'from', ownerKey: 'id');
    }

    public function toBank(): BelongsTo
    {
        return $this->belongsTo(related: Bank::class, foreignKey: 'to', ownerKey: 'id');
    }

    public function userTransactions()
    {
        $banks = Bank::query()->where('account_owner', auth()->user()->id)->get();
        for ($i = 0; $i < count($banks); $i++) {
            $transactions = Transaction::query()->where('to', $banks[$i]->id)->orWhere('from', $banks[$i]->id)/*->with('tags')*/;
        }
        return $transactions;
    }
}
