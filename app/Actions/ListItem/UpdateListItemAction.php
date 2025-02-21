<?php

namespace App\Actions\ListItem;

use App\DTOs\ListItemDTO;
use App\Models\ListItem;

class UpdateListItemAction
{
    public function run(ListItemDTO $listItemDTO, ListItem $listItem): ListItem
    {
        $listItem->list_title_id = $listItemDTO->list_title_id ?? $listItem->list_title_id;
        $listItem->name = $listItemDTO->name ?? $listItem->name;
        $listItem->is_complete = $listItemDTO->is_complete ?? $listItem->is_complete;

        $listItem->save();
        $listItem->refresh();

        return $listItem;
    }
}
