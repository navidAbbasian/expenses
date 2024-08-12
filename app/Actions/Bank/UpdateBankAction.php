<?php

namespace App\Actions\Bank;

use App\DTOs\BankDTO;
use App\Models\Bank;

class UpdateBankAction
{
    public function run(BankDTO $bankDTO, Bank $bank): Bank
    {
        $bank->name = $bankDTO->name ?? $bank->name;
        $bank->account_number = $bankDTO->account_number ?? $bank->account_number;

        $bank->save();
        $bank->refresh();

        return $bank;
    }
}
