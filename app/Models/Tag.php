<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Support\Facades\Auth;

class Tag extends Model
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
    }
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
