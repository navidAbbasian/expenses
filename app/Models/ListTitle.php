<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Facades\Auth;

class ListTitle extends Model
{

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
    protected $fillable = ['name'];

    public function items(): HasMany
    {
        return $this->hasMany(ListItem::class);
    }
}
