<?php

namespace App\Actions\ListItem;

use App\Models\ListItem;

class DeleteListItemAction
{
    public function run(ListItem $listItem): ?bool
    {
        return $listItem->delete();
    }
}
