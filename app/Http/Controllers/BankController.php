<?php

namespace App\Http\Controllers;

use App\Http\Requests\BankRequest;
use App\Models\Bank;
use Illuminate\Http\Request;

class BankController extends Controller
{
    public function store(BankRequest $request): \Illuminate\Http\JsonResponse
    {
        $data = [
            'name' => $request->name,
            'account_number' => $request->account_number,
            'account_owner' => $request->account_owner,
        ];

        $bank = Bank::create($data);

        return $this->created($bank);
    }

    public function index(Request $request)
    {

        $banks = auth()->user()->banks();

        $pagination = $this->pagination($banks, $request);

        return $this->ok($pagination);
    }

    public function show(Bank $bank): \Illuminate\Http\JsonResponse
    {
        return $this->ok($bank);
    }

    public function update(BankRequest $request, Bank $bank): \Illuminate\Http\JsonResponse
    {
        $data = [
            'name' => $request->name,
            'account_number' => $request->account_number,
            'account_owner' => $request->account_owner,
        ];
        $bank->update($data);

        return $this->ok($bank);
    }

    public function delete(Bank $bank): \Illuminate\Http\JsonResponse
    {
        $bank->delete();
        return $this->noContent();
    }
}
