<?php

namespace App\Actions\Transaction;

use App\DTOs\TransactionDTO;
use App\Models\Bank;
use App\Models\Transaction;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\ValidationException;

class CreateTransactionAction
{
    public function run(TransactionDTO $transactionDTO): Transaction
    {
        DB::beginTransaction();

        $tags = $transactionDTO->tag_ids;
        $transactionDTO->tag_ids = null;


        $transaction = $transactionDTO->toModel();

        $transaction->from = $transactionDTO->from ?: null;
        $transaction->to = $transactionDTO->to ?: null;

        $transaction->save();
        $transaction->refresh();

        // set tags for transactions
        $transaction->tags()->attach($tags);

        // change bank balance
        if ($transactionDTO->type == 'income') {
            $bank = Bank::query()->find($transactionDTO->to);

            $bank->balance += $transaction->amount;
            $bank->save();
        }

        if ($transactionDTO->type == 'cost') {
            $bank = Bank::query()->find($transactionDTO->from);
            if ($transactionDTO->amount <= $bank->balance) {
                $bank->balance -= $transaction->amount;
                $bank->save();
            } else {
                throw ValidationException::withMessages(
                    [
                        'amount' => 'از سقف زدی بالا'
                    ]);
            }
        }

        DB::commit();

        return $transaction;
    }
}
