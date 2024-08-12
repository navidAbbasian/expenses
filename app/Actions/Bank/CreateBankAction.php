<?php

namespace App\Actions\Bank;

use App\DTOs\BankDTO;
use App\Models\Bank;

class CreateBankAction
{
    public function run(BankDTO $bankDTO): Bank
    {
        $bank = $bankDTO->toModel();
        $bank->account_owner = auth()->id();

        $bank->save();
        $bank->refresh();

        return $bank;
    }
}
