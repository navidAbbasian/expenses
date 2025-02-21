<?php

namespace App\Actions\List;

use App\Models\ListTitle;

class DeleteListAction
{
    public function run(ListTitle $list): ?bool
    {
        return $list->delete();
    }
}
