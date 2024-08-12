<?php

namespace App\Actions\Transaction;

use App\Models\Bank;
use App\Models\Transaction;

class DeleteTransactionAction
{
    public function run(Transaction $transaction): ?bool
    {
        // reset bank balance
        if ($transaction->type == 'cost') {
            $bank = Bank::query()->find($transaction->from);
            $bank->balance += $transaction->amount;
            $bank->save();
        } else if ($transaction->type == 'income') {
            $bank = Bank::query()->find($transaction->to);
            $bank->balance -= $transaction->amount;
            $bank->save();
        }
        return $transaction->delete();
    }
}
