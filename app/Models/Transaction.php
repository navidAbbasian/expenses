<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Support\Facades\Auth;
use LaravelIdea\Helper\App\Models\_IH_Transaction_QB;

class Transaction extends Model
{
    use HasFactory;

    protected static function boot(): void
    {
        parent::boot();

        static::creating(function ($model) {
            if (Auth::check()) {
                $model->user_id = auth()->id();
            }
        });

        static::saving(function ($model){
            if (Auth::check()) {
                $model->user_id = auth()->id();
            }
        });

        static::deleting(function ($model) {
            $model->tags()->detach();
        });
    }
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

    public function userTransactions(): _IH_Transaction_QB|Builder
    {
        $transactions = [];
        $banks = Bank::query()->where('account_owner', auth()->user()->id)->get();
        for ($i = 0; $i < count($banks); $i++) {
            $transactions = Transaction::query()->where('to', $banks[$i]->id)->orWhere('from', $banks[$i]->id)/*->with('tags')*/;
        }
        return $transactions;
    }
}
