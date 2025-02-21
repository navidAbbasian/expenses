<?php

namespace App\Actions\List;

use App\DTOs\ListTitleDTO;
use App\Models\ListTitle;

class CreateListAction
{
    public function run(ListTitleDTO $listTitleDto): ListTitle
    {
        $list = $listTitleDto->toModel();

        $list->save();
        $list->refresh();

        return $list;
    }
}
