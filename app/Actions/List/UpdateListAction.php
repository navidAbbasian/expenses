<?php

namespace App\Actions\List;

use App\DTOs\ListTitleDTO;
use App\Models\ListTitle;

class UpdateListAction
{
    public function run(ListTitleDTO $listTitleDTO, ListTitle $list): ListTitle
    {
        $list->name = $listTitleDTO->name ?? $list->name;
        $list->type = $listTitleDTO->type ?? $list->type;

        $list->save();
        $list->refresh();

        return $list;
    }
}
