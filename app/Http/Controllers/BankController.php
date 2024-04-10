<?php

namespace App\Http\Controllers;

use App\Http\Requests\BankRequest;
use App\Models\Bank;
use Illuminate\Http\Request;

class BankController extends Controller
{
    public function store(BankRequest $request)
    {
        $data = [
            'name' => $request->name,
            'account_number' => $request->account_number,
            'account_owner' => $request->account_owner,
        ];

        $bank = Bank::create($data);

        return $this->created($bank);
    }

    public function index()
    {
//        $banks = Bank::all();
        $banks=auth()->user()->banks()->get();

        return $this->ok($banks);
    }

    public function show(Bank $bank){
        return $this->ok($bank);
    }

    public function update(BankRequest $request, Bank $bank){
        $data = [
            'name' => $request->name,
            'account_number' => $request->account_number,
            'account_owner' => $request->account_owner,
        ];
        $bank->update($data);

        return $this->ok($bank);
    }

    public function delete(Bank $bank){
        $bank->delete();
        return $this->noContent();
    }
}
