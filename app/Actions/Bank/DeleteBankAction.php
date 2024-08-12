<?php

namespace App\Actions\Bank;

use App\Models\Bank;

class DeleteBankAction
{
    public function run(Bank $bank): ?bool
    {
        return $bank->delete();
    }
}
