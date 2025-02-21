<?php

namespace App\Http\Controllers;

use App\Actions\Bank\CreateBankAction;
use App\Actions\Bank\DeleteBankAction;
use App\Actions\Bank\UpdateBankAction;
use App\DTOs\BankDTO;
use App\Http\Requests\CreateBankRequest;
use App\Http\Requests\UpdateBankRequest;
use App\Http\Resources\BankCollection;
use App\Http\Resources\BankResource;
use App\Models\Bank;
use App\Repositories\BankRepository;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Psr\Container\ContainerExceptionInterface;
use Psr\Container\NotFoundExceptionInterface;

class BankController extends Controller
{
    public function __construct(protected CreateBankAction $createBankAction,
                                protected UpdateBankAction     $updateBankAction,
                                protected DeleteBankAction $deleteBankAction,
                                protected BankRepository       $bankRepository)
    {
    }

    public function store(CreateBankRequest $request): JsonResponse
    {
        $bank = $this->createBankAction->run(BankDTO::fromRequest($request));

        return $this->created(BankResource::make($bank));
    }

    /**
     * @throws ContainerExceptionInterface
     * @throws NotFoundExceptionInterface
     */
    public function index(Request $request)
    {
        $banks = $this->bankRepository->paginate($request->limit, auth()->user()->banks());

        return $this->ok(
            BankCollection::make($banks)
                ->resource
        );
    }

    public function show(Bank $bank): JsonResponse
    {
        $bank = $this->bankRepository->getOneByModelBinding($bank);
        return $this->ok(BankResource::make($bank));
    }

    public function update(UpdateBankRequest $request, Bank $bank): JsonResponse
    {
        $bank = $this->updateBankAction->run(BankDTO::fromRequest($request), $bank);

        return $this->ok(BankResource::make($bank));
    }

    public function delete(Bank $bank): JsonResponse
    {

        $this->deleteBankAction->run($bank);

        return $this->noContent();
    }
}
