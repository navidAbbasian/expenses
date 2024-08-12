<?php

namespace App\Http\Controllers;

use App\Actions\Transaction\CreateTransactionAction;
use App\Actions\Transaction\DeleteTransactionAction;
use App\DTOs\TransactionDTO;
use App\Http\Requests\CreateTransactionRequest;
use App\Http\Resources\TransactionCollection;
use App\Http\Resources\TransactionResource;
use App\Models\Transaction;
use App\Repositories\TransactionRepository;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Psr\Container\ContainerExceptionInterface;
use Psr\Container\NotFoundExceptionInterface;

class TransactionController extends Controller
{
    public function __construct(protected CreateTransactionAction $createTransactionAction,
                                protected DeleteTransactionAction $deleteTransactionAction,
                                protected TransactionRepository $transactionRepository)
    {
    }

    public function store(CreateTransactionRequest $request): JsonResponse
    {
        $transaction = $this->createTransactionAction->run(TransactionDTO::fromRequest($request));

        return $this->created(TransactionResource::make($transaction));
    }

    /**
     * @throws ContainerExceptionInterface
     * @throws NotFoundExceptionInterface
     */
    public function index(Request $request): JsonResponse
    {
        $transactions = $this->transactionRepository->paginate($request->limit);
        return $this->ok(
            TransactionCollection::make($transactions)
                ->resource
        );
    }

    public function delete(Transaction $transaction): JsonResponse
    {

        $this->deleteTransactionAction->run($transaction);

        return $this->noContent();
    }

    public function show(Transaction $transaction): JsonResponse
    {
        $transaction = $this->transactionRepository->getOneByModelBinding($transaction);
        return $this->ok(
            TransactionResource::make($transaction)
        );
    }
}
