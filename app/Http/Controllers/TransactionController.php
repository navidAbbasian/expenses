<?php

namespace App\Http\Controllers;

use App\Http\Requests\TransactionRequest;
use App\Models\Transaction;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class TransactionController extends Controller
{
    public function store(TransactionRequest $request): JsonResponse
    {
        $data = [
            'amount' => $request->amount,
            'description' => $request->description,
            'type' => $request->type,
            'from' => $request->from,
            'to' => $request->has($request->to) ? $request->to : null,
        ];

        $tags = $request->tag_ids;

        $transaction = Transaction::query()->create($data);

        $transaction->tags()->attach($tags);

        return $this->created($transaction);
    }

    public function index(): JsonResponse
    {
        $transactions = Transaction::with(relations: 'tags')->where(column: 'from', value: auth()->user()->banks()->id)->get();

        return $this->ok($transactions);
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
}
