<?php

namespace App\Http\Controllers;

use App\Http\Requests\TransactionRequest;
use App\Models\Bank;
use App\Models\Transaction;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\ValidationException;

class TransactionController extends Controller
{
    public function store(TransactionRequest $request): JsonResponse
    {

        DB::beginTransaction();
        $data = [
            'amount' => $request->amount,
            'description' => $request->description,
            'type' => $request->type,
            'from' => ($request->has('from')) ? $request->from : null,
            'to' => ($request->has('to')) ? $request->to : null,
        ];


        $tags = $request->tag_ids;

        $transaction = Transaction::query()->create($data);

        $transaction->tags()->attach($tags);


        // change bank balance

        if ($request->type == 'income') {
            $bank = Bank::query()->find($request->to);

            $bank->balance += $transaction->amount;
            $bank->save();
        }

        if ($request->type == 'cost') {
            $bank = Bank::query()->find($request->from);
            if ($request->amount <= $bank->balance) {
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
        return $this->created($transaction);
    }

    public function index(Transaction $transactions): JsonResponse
    {
        return $this->ok($transactions->userTransactions());
    }

    public function update(TransactionRequest $request, Transaction $transaction): JsonResponse
    {
        $data = [
            'amount' => $request->amount,
            'type' => $request->type
        ];

        $tags = $request->tag_ids;


        $transaction->update($data);

        $transaction->tags()->detach();
        $transaction->tags()->attach($tags);

        return $this->ok($transaction);
    }

    public function delete(Transaction $transaction): JsonResponse
    {
        $transaction->delete();

        return $this->noContent();
    }
    public function show(Transaction $transaction): JsonResponse
    {
        return $this->ok($transaction);
    }
}
