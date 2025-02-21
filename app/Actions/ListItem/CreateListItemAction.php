<?php

namespace App\Actions\ListItem;

use App\DTOs\ListItemDTO;
use App\Models\ListItem;

class CreateListItemAction
{
    public function run(ListItemDTO $listItemDTO): ListItem
    {
        $listItem = $listItemDTO->toModel();
        $listItem->list_title_id = $listItemDTO->list_title_id;
        $listItem->is_complete = $listItemDTO->is_complete;

        $listItem->save();
        $listItem->refresh();

        return $listItem;
    }
}
