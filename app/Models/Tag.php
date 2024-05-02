<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Tag extends Model
{
    use HasFactory;

    protected $guarded = [];

//    protected $appends = ['sum_tag_transaction'];

    public function transactions(): BelongsToMany
    {
        return $this->belongsToMany(related: Transaction::class,table: 'tags_transactions',foreignPivotKey: 'tag_id',relatedPivotKey: 'transaction_id');
    }

    public function getSumTagTransactionAttribute()
    {
        return $this->transactions()->sum('amount');
//        $tags = Tag::all();
//        for ($i = 0; $i <count($tags) ; $i++) {
//            $tagsTransactions[$i] = $tags[$i]->transactions()->sum('amount');
//            $tagsName[$i] = $tags[$i]->name;
//            $tagBalance[$i] = [
//                $tagsName[$i] => $tagsTransactions[$i]
//            ];
//        }
//        return $tagBalance;
    }
}
